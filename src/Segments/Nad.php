<?php

namespace Proengeno\EdiEnergy\Segments;

use Proengeno\Edifact\Templates\AbstractSegment;

class Nad extends AbstractSegment
{
    const PERSON_ADRESS = 'Z01';
    const COMPANY_ADRESS = 'Z02';

    protected static $validationBlueprint = [
        'NAD' => ['NAD' => 'M|an|3'],
        '3035' => ['3035' => 'M|an|3'],
        'C082' => ['3039' => 'D|an|35', '1131' => null, '3055' => 'D|an|3'],
        'C058' => ['3124' => null],
        'C080' => ['3036:1' => 'D|an|70', '3036:2' => 'D|an|70', '3036:3' => 'D|an|70', '3036:4' => 'D|an|70', '3036:5' => 'D|an|70', '3045' => 'D|an|3'],
        'C059' => ['3042:1' => 'D|an|35', '3042:2' => 'D|an|35', '3042:3' => 'D|an|35', '3042:4' => 'D|an|35'],
        '3164' => ['3164' => 'D|an|35'],
        'C819' => ['3229' => null],
        '3251' => ['3251' => 'D|an|17'],
        '3207' => ['3251' => 'D|an|3'],
    ];

    public static function fromAttributes(
        $qualifier,
        $id,
        $idCode,
        $lastName,
        $firstName,
        $additionalName1,
        $additionalName2,
        $title,
        $partnerType,
        $street,
        $number,
        $district,
        $city,
        $zip,
        $country = 'DE'
    )
    {
        return new static([
            'NAD' => ['NAD' => 'NAD'],
            '3035' => ['3035' => $qualifier],
            'C082' => ['3039' => $id, '1131' => null, '3055' => $idCode],
            'C058' => ['3124' => null],
            'C080' => [
                '3036:1' => $lastName,
                '3036:2' => $firstName,
                '3036:3' => $additionalName1,
                '3036:4' => $additionalName2,
                '3036:5' => $title,
                '3045' => $partnerType
            ],
            'C059' => ['3042:1' => substr($street, 0, 35), '3042:2' => substr($street, 35), '3042:3' => $number, '3042:4' => $district],
            '3164' => ['3164' => $city],
            'C819' => ['3229' => null],
            '3251' => ['3251' => $zip],
            '3207' => ['3251' => $country]
        ]);
    }

    public static function fromMpCode($qualifier, $id, $idCode)
    {
        return static::fromAttributes(
            $qualifier, $id, $idCode, null, null, null, null, null, null, null, null, null, null, null, null
        );
    }

    public static function fromPersonAdress($qualifier, $lastName, $firstName, $street, $number, $city, $zip, $title = null, $district = null)
    {
        return static::fromAttributes(
            $qualifier, null, null, $lastName, $firstName, null, null, $title, self::PERSON_ADRESS, $street, $number, $district, $city, $zip
        );
    }

    public static function fromCompanyAdress($qualifier, $company, $street, $number, $city, $zip, $title = null, $district = null)
    {
        return static::fromAttributes(
            $qualifier, null, null, substr($company, 0, 70), substr($company, 70), null, null, $title, self::COMPANY_ADRESS, $street, $number, $district, $city, $zip
        );
    }

    public static function fromPerson($qualifier, $lastName, $firstName, $title = null, $additionalName1 = null, $additionalName2 = null)
    {
        return static::fromAttributes(
            $qualifier, null, null, $lastName, $firstName, $additionalName1, $additionalName2, $title, self::PERSON_ADRESS, null, null, null, null, null, null
        );
    }

    public static function fromCompany($qualifier, $company, $additionalName1 = null, $additionalName2 = null)
    {
        return static::fromAttributes(
            $qualifier, null, null, substr($company, 0, 70), substr($company, 70), $additionalName1, $additionalName2, null, self::COMPANY_ADRESS, null, null, null, null, null, null
        );
    }

    public static function fromAdress($qualifier, $street, $number, $city, $zip, $district = null)
    {
        return static::fromAttributes(
            $qualifier, null, null, null, null, null, null, null, null, $street, $number, $district, $city, $zip
        );
    }

    public function qualifier()
    {
        return $this->elements['3035']['3035'];
    }

    public function id()
    {
        return $this->elements['C082']['3039'];
    }

    public function idCode()
    {
        return $this->elements['C082']['3055'];
    }

    public function street()
    {
        $street = null;
        if (isset($this->elements['C059']['3042:1'])) {
            $street .= $this->elements['C059']['3042:1'];
        }
        if (isset($this->elements['C059']['3042:2'])) {
            $street .= $this->elements['C059']['3042:2'];
        }
        return $street;
    }

    public function number()
    {
        return @$this->elements['C059']['3042:3'];
    }

    public function district()
    {
        return @$this->elements['C059']['3042:4'];
    }

    public function company()
    {
        if ($this->partnerType() != self::COMPANY_ADRESS) {
            return null;
        }

        return $this->elements['C080']['3036:1'] . $this->elements['C080']['3036:2'];
    }

    public function firstName()
    {
        if ($this->partnerType() != self::PERSON_ADRESS) {
            return null;
        }

        return $this->elements['C080']['3036:2'];
    }

    public function lastName()
    {
        if ($this->partnerType() != self::PERSON_ADRESS) {
            return null;
        }

        return $this->elements['C080']['3036:1'];
    }

    public function additionalName1()
    {
        return $this->elements['C080']['3036:3'];
    }

    public function additionalName2()
    {
        return $this->elements['C080']['3036:4'];
    }

    public function title()
    {
        return $this->elements['C080']['3036:5'];
    }

    public function partnerType()
    {
        return $this->elements['C080']['3045'];
    }

    public function zip()
    {
        return $this->elements['3251']['3251'];
    }

    public function city()
    {
        return $this->elements['3164']['3164'];
    }
}
