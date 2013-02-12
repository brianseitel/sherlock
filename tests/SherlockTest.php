<?php
namespace sherlock;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-02-07 at 03:12:53.
 */
class SherlockTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Sherlock
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Sherlock;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }


	/**
	 * @covers sherlock\Sherlock::addNode
	 */
	public function testAddNode()
	{
		$ret = $this->object->addNode('loopback.com');
		$this->assertInstanceOf('\sherlock\sherlock', $ret);

	}



    /**
     * @covers sherlock\Sherlock::query
	 * @todo make this test actually assert things
     */
    public function testBuildQuery()
    {
		$this->object->addNode('loopback.com', '9200');
		$req = $this->object->search();
		$req->index("test")->type("benchmark");
		$req->query($this->object->query()->Term()->field("field1")->term("town"));
		$resp = $req->execute();

		echo $resp->took;
		foreach($resp as $hit)
		{
			echo $hit['score'].' - '.$hit['source']['field1']."\r\n";
		}




    }



}
