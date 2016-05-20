<?php

namespace Proengeno\EdiMessages\Test\Remadv33001;

use DateTime;
use SplFileInfo;
use Mockery as m;
use Proengeno\EdiMessages\Test\TestCase;
use Proengeno\EdiMessages\Remadv\RemadvInterface;
use Proengeno\EdiMessages\Remadv\R33001\RemadvR33001;
use Proengeno\EdiMessages\Remadv\R33001\RemadvR33001Builder;

class Remadv33001BuilderTest extends TestCase 
{
    private $remadvBuilder;
    private $edifactFile;

    public function setUp()
    {
        $this->remadvBuilder = new RemadvR33001Builder('from', 'to', 'w+');
    }

    public function tearDown()
    {
        if ($this->edifactFile) {
            @unlink($this->edifactFile->getFilepath());
        }
    }

    /** @test */
    public function it_instanciate_the_korrekt_class()
    {
        $this->assertInstanceOf(RemadvR33001Builder::class, $this->remadvBuilder);
    }

    /** @test */
    public function it_build_up_the_RemadvR33001_instance()
    {
        $this->assertInstanceOf(RemadvR33001::class, $this->edifactFile = $this->remadvBuilder->get());
    }

    /** @test */
    public function it_creates_a_valid_electric_message()
    {
        $this->edifactFile = $this->remadvBuilder->setEnergieType('electric')->addMessage([$this->makeRemadvMock()])->get();
        $this->assertEquals('500', $this->edifactFile->findNextSegment('UNB')->senderQualifier());
        $this->assertEquals('293', $this->edifactFile->findNextSegment('NAD')->idCode());
        $this->edifactFile->validate();
    }

    /** @test */
    public function it_creates_a_valid_gas_message()
    {
        $this->edifactFile = $this->remadvBuilder->setEnergieType('gas')->addMessage([$this->makeRemadvMock()])->get();

        $this->assertEquals('502', $this->edifactFile->findNextSegment('UNB')->senderQualifier());
        $this->assertEquals('332', $this->edifactFile->findNextSegment('NAD')->idCode());
        $this->edifactFile->validate();
    }

    private function makeRemadvMock($invoiceAmount = 10, $accountNumber = 1, $invoiceDate = '2015-01-01', $invoiceCode = 380)
    {
        return m::mock(RemadvInterface::class, function($remadvModel) use ($invoiceAmount, $accountNumber, $invoiceDate, $invoiceCode) {
            $remadvModel->shouldReceive('getAmount')->andReturn($invoiceAmount);
            $remadvModel->shouldReceive('getAccountNumber')->andReturn($accountNumber);
            $remadvModel->shouldReceive('getInvoiceDate')->andReturn(new DateTime($invoiceDate));
            $remadvModel->shouldReceive('getInvoiceCode')->andReturn($invoiceCode);
        });
    }
    
}
