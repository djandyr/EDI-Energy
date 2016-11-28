<?php

namespace Proengeno\EdiEnergy\Utilmd\U11022;

use DateTime;
use Proengeno\EdiEnergy\Utilmd\UtilmdBuilder;

class UtilmdU11022Builder extends UtilmdBuilder
{
    const CHECK_DIGIT = 11022;

    public function getDescriptionPath()
    {
        return __DIR__ . '/UtilmdU11022.php';
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
        $this->writeSeg('Bgm', ['E01', $this->unbReference()]);
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

    private function writeItem($item)
    {
        $this->writeSeg('Ide', ['24', 'IDE_REFERENCE']);
        $this->writeSeg('Imd', ['Z14', 'Z07']);
        $this->writeSeg('Dtm', ['92', new DateTime('2016-06-15'), 102]);
        $this->writeSeg('Dtm', ['158', new DateTime('2016-06-15'), 102]);
        $this->writeSeg('Dtm', ['752', new DateTime('2016-03-10'), 106]);
        $this->writeSeg('Dtm', ['Z09', new DateTime('2016-03-10'), 602]);
        $this->writeSeg('Dtm', ['672', new DateTime('2016-03-10'), 802]);
        $this->writeSeg('Sts', ['7', 'E01']);
        $this->writeSeg('Sts', ['E01', 'Z43']);
        $this->writeSeg('Agr', ['11', 'E02']);
        $this->writeSeg('Agr', ['E03', 'E10']);
        $this->writeSeg('Loc', ['107', '11YR00000003319J']);
        $this->writeSeg('Loc', ['237', '11XSTROMMIXER--E']);
        $this->writeSeg('Loc', ['172', 'DE0002914465200000000000000006517']);
        $this->writeSeg('Rff', ['Z13', '11022']);
        $this->writeSeg('Rff', ['TN', 'UE01-26823-166A4DDC4FA']);
        $this->writeSeg('Cci', ['Z02', 'E01']);
        $this->writeSeg('Cav', ['H1', '89']);
        $this->writeSeg('Cci', [null, 'E02']);
        $this->writeSeg('Cav', ['E02']);
        $this->writeSeg('Cci', [null, 'E03']);
        $this->writeSeg('Cav', ['E06']);
        $this->writeSeg('Cci', [null, 'Z15']);

        $this->writeSeg('Seq', ['Z01']);
        $this->writeSeg('Rff', ['AVE', 'DE0002914465200000000000000006517']);
        $this->writeSeg('Qty', ['31', '2293.5', 'KWH']);
        $this->writeSeg('Cci', ['15', 'Z21']);
        $this->writeSeg('Cav', ['SLS']);
        $this->writeSeg('Cci', [null, 'E04']);
        $this->writeSeg('Cav', ['E06']);

        $this->writeSeg('Seq', ['Z02']);
        $this->writeSeg('Rff', ['AVE', 'DE0002914465200000000000000006517']);
        $this->writeSeg('Rff', ['MG', '987654321']);
        $this->writeSeg('Pia', ['5', '1-1:1.8.0', 'SRW']);
        $this->writeSeg('Cci', ['11', 'Z33']);
        $this->writeSeg('Cav', [null, null, '6', '1']);

        $this->writeSeg('Seq', ['Z03']);
        $this->writeSeg('Rff', ['AVE', 'DE0002914465200000000000000006517']);
        $this->writeSeg('Cci', [null, 'E13']);
        $this->writeSeg('Cav', ['AHZ']);
        $this->writeSeg('Cav', ['Z30', null, '1000564062']);
        $this->writeSeg('Cav', ['ETZ']);
        $this->writeSeg('Cav', ['ERZ']);
        $this->writeSeg('Cci', [null, 'E12']);
        $this->writeSeg('Cav', ['MMR']);

        $this->writeSeg('Seq', ['Z07']);
        $this->writeSeg('Rff', ['AVE', 'DE0002914465200000000000000006517']);
        $this->writeSeg('Rff', ['Z10', '1-1:1.8.0']);
        $this->writeSeg('Cci', [null, 'Z08']);
        $this->writeSeg('Cav', ['TA']);

        $this->writeSeg('Seq', ['Z10']);
        $this->writeSeg('Rff', ['AVE', 'DE0002914465200000000000000006517']);
        $this->writeSeg('Rff', ['Z10', '1-1:1.8.0']);
        $this->writeSeg('Cci', ['Z13', 'Z66']);

        $this->writeSeg('Seq', ['Z12']);
        $this->writeSeg('Qty', ['Z16', '0.0', 'P1']);

        $this->writeSeg('Nad', ['UD', 'Thörmer', 'Kay'], 'fromPerson');
        $this->writeSeg('Nad', ['DEB', '9904746000004', '293'], 'fromMpCode');
        $this->writeSeg('Rff', ['Z05', 'JA']);

        $this->writeSeg('Rff', ['AVE', 'DE0002914465200000000000000006517']);
        $this->writeSeg('Nad', ['DDE', '9904778000006', '293'], 'fromMpCode');
        $this->writeSeg('Rff', ['Z05', 'JA']);

        $this->writeSeg('Rff', ['AVE', 'DE0002914465200000000000000006517']);
        $this->writeSeg('Nad', ['DP', 'Kastanienallee', '21', 'Herne', '44652', 'Wanne-Süd'], 'fromAdress');
        $this->writeSeg('Nad', ['Z04', 'Schmiedestr.', '7', 'Bochum', '44866', 'Günnigfeld'], 'fromAdress');
        $this->writeSeg('Nad', ['Z05', 'Thörmer', 'Kay', 'Schmiedestr.', '7', 'Bochum', '44866', null, 'Günnigfeld'], 'fromPersonAdress');
        $this->writeSeg('Rff', ['AVE', 'DE0002914465200000000000000006517']);
    }
}
