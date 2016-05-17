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
    public function it()
    {
        $accountNumber = 'RN12345';
        $invoiceCode = 380;
        $invoiceDate = new DateTime('2015-01-01');
        $invoiceAmount = 10.00;

        $remadvModel = m::mock(RemadvInterface::class, function($remadvModel) use ($invoiceAmount, $accountNumber, $invoiceDate, $invoiceCode) {
            $remadvModel->shouldReceive('getAmount')->andReturn($invoiceAmount);
            $remadvModel->shouldReceive('getAccountNumber')->andReturn($accountNumber);
            $remadvModel->shouldReceive('getInvoiceDate')->andReturn($invoiceDate);
            $remadvModel->shouldReceive('getInvoiceCode')->andReturn($invoiceCode);
        });
        $this->remadvBuilder->addMessage([$remadvModel]);

        $edifact = $this->remadvBuilder->get();
        
        echo "\n" . (string)$edifact . "\n";
        unlink($edifact->getFilepath());
    }
}
