<?php

namespace Proengeno\EdiEnergy\Utilmd\U11016;

use DateTime;
use Proengeno\EdiEnergy\Utilmd\UtilmdBuilder;
use Proengeno\EdiEnergy\Interfaces\Utilmd\SupplierSupllierSigningOffInterface;

class UtilmdU11016Builder extends UtilmdBuilder
{
    const CHECK_DIGIT = 11016;

    public function getDescriptionPath()
    {
        return __DIR__ . '/UtilmdU11016.php';
    }

    protected function writeMessage($items)
    {
        $this->writeSeg('Unh', [
            $this->unbReference(),
            self::MESSAGE_TYPE,
            self::VERSION_NUMBER,
            self::RELEASE_NUMBER,
            self::ORGANISATION,
            self::ORGANISATION_CODE
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

    private function writeItem(SupplierSupllierSigningOffInterface $item)
    {
        $this->writeSeg('Ide', ['24', $item->getIdeRef()]);
        $this->writeSeg('Imd', ['Z14', 'Z07']);
        if ($item->isFixedSignOff()) {
            $this->writeSeg('Dtm', ['93', $item->getSignOffDate(), 102]);
        }
        if (!$item->isFixedSignOff()) {
            $this->writeSeg('Dtm', ['471', $item->getSignOffDate(), 102]);
        }
        $this->writeSeg('Sts', ['7', 'E03']);
        if ($item->getComments() === null) {
            $this->writeSeg('Ftx', ['ACB', $item->getComments()]);
        }
        $this->writeSeg('Loc', ['172', $item->getMeterpoint()]);
        $this->writeSeg('Rff', ['Z13', '11016']);

        $this->writeSeg('Seq', ['Z03']);
        $this->writeSeg('Cci', [null, 'E13']);
        $this->writeSeg('Cav', ['Z30', null, $item->getMeterNumber()]);

        if ($item->getCompany() === null) {
            $this->writeSeg('Nad', ['UD', $item->getFirstName(), $item->getLastName()], 'fromPerson');
        } else {
            $this->writeSeg('Nad', ['UD', $item->getCompany()], 'fromCompany');
        }

        $this->writeSeg('Nad', [
            'DP',
            $item->getStreet(),
            $item->getStreetNumber(),
            $item->getCity(),
            $item->getZip()
        ], 'fromAdress');
    }
}
