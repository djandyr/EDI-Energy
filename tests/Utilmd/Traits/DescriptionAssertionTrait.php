<?php

namespace Proengeno\EdiEnergy\Test\Utilmd;

use Proengeno\Edifact\Message\Message;

trait DescriptionAssertionTrait
{
    private function assertDescriptions(Message $message)
    {
        $unh = $message->findSegmentFromBeginn('UNH');
        $cta = $message->findNextSegment('CTA');
        $com = $message->findNextSegment('COM');
        $com2 = $message->findNextSegment('COM');

        $this->assertEquals($message->getDescription('versions.message_type'), $unh->type());
        $this->assertEquals($message->getDescription('versions.version_number'), $unh->versionNumber());
        $this->assertEquals($message->getDescription('versions.release_number'), $unh->releaseNumber());
        $this->assertEquals($message->getDescription('versions.organisation'), $unh->organisation());
        $this->assertEquals($message->getDescription('versions.organisation_code'), $unh->organisationCode());
        $this->assertEquals($message->getDescription('contact.name'), $cta->employee());
        $this->assertEquals($message->getDescription('contact.phone'), $com->id());
        $this->assertEquals($message->getDescription('contact.email'), $com2->id());
    }
}
