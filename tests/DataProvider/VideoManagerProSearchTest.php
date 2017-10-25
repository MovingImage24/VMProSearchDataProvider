<?php

namespace MovingImage\DataProvider\Tests\VideoCollectionBundle\DataProvider;

use MovingImage\Client\VMPro\Entity\VideosRequestParameters;
use MovingImage\DataProvider\VideoManagerProSearch;
use MovingImage\Client\VMPro\Collection\VideoCollection;

class VideoManagerProSearchTest extends \PHPUnit_Framework_TestCase
{
    public function testGetData()
    {
        $client = $this->getMockBuilder('MovingImage\Client\VMPro\Interfaces\ApiClientInterface')->getMock();

        $vm_id = 5;
        $limit = 4;
        $total_count = 10;

        $videoRequestParameters = new VideosRequestParameters();
        $videoRequestParameters->set('limit', $limit);

        $options = ['vm_id' => $vm_id, 'limit' => $limit];

        $videoCollection = new VideoCollection($total_count, []);

        $client
            ->expects($this->once())
            ->method('searchVideos')
            ->with($vm_id, $videoRequestParameters)
            ->will($this->returnValue($videoCollection));

        $dataProvider = new VideoManagerProSearch($client);

        $return = $dataProvider->getAll($options);

        $this->assertEquals([], $return);
    }
}