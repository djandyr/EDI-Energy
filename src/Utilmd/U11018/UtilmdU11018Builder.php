<?php

namespace Proengeno\EdiEnergy\Utilmd\U11018;

use DateTime;
use Proengeno\EdiEnergy\Utilmd\UtilmdBuilder;
use Proengeno\EdiEnergy\Interfaces\Utilmd\Consumer\Supplier\SupllierSignOffResponseInterface;

class UtilmdU11018Builder extends UtilmdBuilder
{
    const CHECK_DIGIT = 11018;

    const ANSWER_OTHER_REASON = 'E14';
    const ANSWER_MULTIPLE_SIGN_OFFS = 'Z34';
    const ANSWER_CONTRACT_COMMITMENT = 'Z12';

    public function getDescriptionPath()
    {
        return __DIR__ . '/UtilmdU11018.php';
    }

    protected function writeMessage($items)
    {
        $this->writeSeg('Unh', [
            $this->unbReference(),
            $this->description->get('versions.message_type'),
            $this->description->get('versions.version_number'),
            $this->description->get('versions.release_number'),
            $this->description->get('versions.organisation'),
            $this->description->get('versions.organisation_code'),
        ]);
        $this->writeSeg('Bgm', ['E35', $this->unbReference()]);
        $this->writeSeg('Dtm', [137, new DateTime, 203]);
        $this->writeSeg('Nad', ['MS', $this->from, $this->getNadQualifier($this->from)], 'fromMpCode');
        $this->writeSeg('Cta', ['IC', 'Herr Geerdes']);
        $this->writeSeg('Com', ['04958 91570-10', 'TE']);
        $this->writeSeg('Com', ['j.geerdes@proengeno.de', 'EM']);
        $this->writeSeg('Nad', ['MR', $this->to, $this->getNadQualifier($this->to)], 'fromMpCode');

        foreach ($items as $item) {
            $this->writeItem($item);
        }

        $this->writeSeg('Unt', [$this->unhCount() + 1, $this->unbReference()]);
    }

    private function writeItem(SupllierSignOffResponseInterface $item)
    {
        $this->writeSeg('Ide', ['24', $item->getIdeRef()]);
        $this->writeSeg('Imd', ['Z14', 'Z07']);

        if ($this->contractHasMultipleSignOffs($item)) {
            if ($item->getSupplierSignOffDate()) {
                $this->writeSeg('Dtm', ['Z06', $item->getSupplierSignOffDate(), 102]);
            } else {
                $this->writeSeg('Dtm', ['Z05', $item->getCustomerSignOffDate(), 102]);
            }
        } elseif ($this->contractIsInCommitment($item)) {
            $this->writeSeg('Dtm', ['157', $item->getContractTermDate(), 102]);
            $this->writeSeg('Dtm', ['Z01', $item->getNoticePeriod(), 'Z01']);
        }

        $this->writeSeg('Sts', ['7', 'E03']);
        $this->writeSeg('Sts', ['E01', $item->getAnswer()]);
        if (static::ANSWER_OTHER_REASON == $item->getAnswer()) {
            $this->writeSeg('Ftx', ['ACB', $item->getComments()]);
        }
        $this->writeSeg('Loc', ['172', $item->getMeterpoint()]);
        $this->writeSeg('Rff', ['Z13', self::CHECK_DIGIT]);
        $this->writeSeg('Rff', ['TN', $item->getRequestRef()]);
    }

    private function contractHasMultipleSignOffs($item)
    {
        return $item->getAnswer() === self::ANSWER_MULTIPLE_SIGN_OFFS;
    }

    private function contractIsInCommitment($item)
    {
        return $item->getAnswer() === self::ANSWER_CONTRACT_COMMITMENT;
    }
}
