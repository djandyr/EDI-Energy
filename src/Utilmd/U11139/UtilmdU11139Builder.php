<?php

namespace Proengeno\EdiEnergy\Utilmd\U11139;

use DateTime;
use Proengeno\EdiEnergy\Utilmd\UtilmdBuilder;
use Proengeno\EdiEnergy\Interfaces\Utilmd\SupplierNoBalancingChangeRequestInterface;

class UtilmdU11139Builder extends UtilmdBuilder
{
    const CHECK_DIGIT = 11139;

    public function getDescriptionPath()
    {
        return __DIR__ . '/UtilmdU11139Description.php';
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
        $this->writeSeg('Bgm', ['E03', $this->unbReference()]);
        $this->writeSeg('Dtm', [137, new DateTime, 203]);
        $this->writeSeg('Nad', ['MS', $this->from, $this->getNadQualifier($this->from)], 'fromMpCode');
        $this->writeSeg('Cta', ['IC', 'Frau Hertema']);
        $this->writeSeg('Com', ['04958 91570-02', 'TE']);
        $this->writeSeg('Com', ['k.hertema@proengeno.de', 'EM']);
        $this->writeSeg('Nad', ['MR', $this->to, $this->getNadQualifier($this->to)], 'fromMpCode');

        foreach ($items as $item) {
            $this->writeItem($item);
        }

        $this->writeSeg('Unt', [$this->unhCount() + 1, $this->unbReference()]);
    }

    private function writeItem(SupplierNoBalancingChangeRequestInterface $item)
    {
        $this->writeSeg('Ide', ['24', $item->getIdeRef()]);
        $this->writeSeg('Imd', ['Z14', 'Z07']);
        $this->writeSeg('Dtm', ['92', $item->getContractStart(), 102]);
        $this->writeSeg('Dtm', ['157', $item->getChangesStart(), 102]);
        $this->writeSeg('Sts', ['7', 'ZF4']);
        if ($item->hasMarketAreaChange()) {
            $this->writeSeg('Loc', ['Z07', $item->getMarketArea()]);
        }
        $this->writeSeg('Loc', ['172', $item->getMeterpoint()]);
        $this->writeSeg('Rff', ['Z13', self::CHECK_DIGIT]);

        $this->writeSeg('Seq', ['Z01']);
        $this->writeSeg('Cci', ['15', 'Z30']);

        $this->writeSeg('Cci', [null, 'Z08']);
        $this->writeSeg('Cav', ['TA']);
        $this->writeSeg('Cci', ['Z13', 'Z66']);
        $this->writeSeg('Qty', ['Z16', '0.0', 'P1']);

        if ($item->hasDeliveryNameChange()) {
            $this->writeSeg('Nad', ['EO', $item->getLastName(), $item->getFirstName()], 'fromPerson');
        } elseif ($item->hasDeliveryCompanyChange()) {
            $this->writeSeg('Nad', ['EO', $item->getCompany()], 'fromCompany');
        }

        if ($item->hasDeliveryAddressChange()) {
            $this->writeSeg('Nad', ['DP', $item->getStreet(), $item->getStreetNo(), $item->getCity(), $item->getZip()], 'fromAdress');
        }
    }
}
