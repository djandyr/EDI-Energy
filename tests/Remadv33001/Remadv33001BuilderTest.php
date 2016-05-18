<?php

namespace Proengeno\EdiMessages\Test\Remadv33001;

use DateTime;
use Mockery as m;
use Proengeno\EdiMessages\Test\TestCase;
use Proengeno\EdiMessages\Remadv\R33001\RemadvR33001;
use Proengeno\EdiMessages\Remadv\Remadv as RemadvInterface;
use Proengeno\EdiMessages\Remadv\R33001\RemadvR33001Builder;

class Remadv33001BuilderTest extends TestCase 
{
    private $remadvBuilder;

    public function setUp()
    {
        $this->remadvBuilder = new RemadvR33001Builder('from', 'to', 'w+');
    }

    /** @test */
    public function it_is_the_Remadv33001Builder_instance()
    {
        $this->assertInstanceOf(RemadvR33001Builder::class, $this->remadvBuilder);
    }

    /** @test */
    public function it_()
    {
        $invoiceCode = 380;
        $invoiceAmount = 10.00;
        $accountNumber = 'RN12345';
        $invoiceDate = new DateTime('2015-01-01');
        
        $this->remadvBuilder->setEnergieType('electric');
        $this->remadvBuilder->addMessage([$this->makeRemadvMock($invoiceAmount, $accountNumber, $invoiceDate, $invoiceCode)]);

        $edifact = $this->remadvBuilder->get();
        $this->assertEquals('502', $edifact->findNextSegment('UNB')->senderQualifier());

        unlink($edifact->getFilepath());
    }

    private function makeRemadvMock($invoiceAmount, $accountNumber, $invoiceDate, $invoiceCode)
    {
        return m::mock(RemadvInterface::class, function($remadvModel) use ($invoiceAmount, $accountNumber, $invoiceDate, $invoiceCode) {
            $remadvModel->shouldReceive('getAmount')->andReturn($invoiceAmount);
            $remadvModel->shouldReceive('getAccountNumber')->andReturn($accountNumber);
            $remadvModel->shouldReceive('getInvoiceDate')->andReturn($invoiceDate);
            $remadvModel->shouldReceive('getInvoiceCode')->andReturn($invoiceCode);
        });
    }
    
}
