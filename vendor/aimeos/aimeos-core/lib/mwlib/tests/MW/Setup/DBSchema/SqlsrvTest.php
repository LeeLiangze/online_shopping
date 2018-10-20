<?php

namespace Aimeos\MW\Setup\DBSchema;


class SqlservTest extends \PHPUnit\Framework\TestCase
{
	private $mock;
	private $object;
	private $dbmStub;


	protected function setUp()
	{
		$this->mock = $this->getMockBuilder( '\Aimeos\MW\DB\Connection\PDO' )
			->setMethods( array( 'create' ) )
			->disableOriginalConstructor()
			->getMock();

		$this->dbmStub = $this->getMockBuilder( '\Aimeos\MW\DB\Manager\PDO' )
			->setMethods( array( 'acquire', 'release' ) )
			->disableOriginalConstructor()
			->getMock();

		$this->object = new \Aimeos\MW\Setup\DBSchema\Sqlsrv( $this->dbmStub, 'db', 'dbname', 'sqlsrv' );
	}


	protected function tearDown()
	{
		unset( $this->object );
	}


	public function testTableExists()
	{
		$stmt = $this->getMockBuilder( '\Aimeos\MW\DB\Statement\PDO\Simple' )
			->setMethods( array( 'bind', 'execute' ) )
			->disableOriginalConstructor()
			->getMock();

		$result = $this->getMockBuilder( '\Aimeos\MW\DB\Result\PDO' )
			->setMethods( array( 'fetch' ) )
			->disableOriginalConstructor()
			->getMock();

		$this->dbmStub->expects( $this->once() )->method( 'acquire' )->will( $this->returnValue( $this->mock ) );
		$this->dbmStub->expects( $this->once() )->method( 'release' )->with( $this->equalTo( $this->mock ) );

		$this->mock->expects( $this->once() )->method( 'create' )->will( $this->returnValue( $stmt ) );
		$stmt->expects( $this->once() )->method( 'execute' )->will( $this->returnValue( $result ) );
		$result->expects( $this->once() )->method( 'fetch' )->will( $this->returnValue( false ) );

		$this->assertFalse( $this->object->tableExists( 'testtable' ) );
	}


	public function testSequenceExists()
	{
		$this->assertFalse( $this->object->sequenceExists( 'testseqence' ) );
	}


	public function testIndexExists()
	{
		$stmt = $this->getMockBuilder( '\Aimeos\MW\DB\Statement\PDO\Simple' )
			->setMethods( array( 'bind', 'execute' ) )
			->disableOriginalConstructor()
			->getMock();

		$result = $this->getMockBuilder( '\Aimeos\MW\DB\Result\PDO' )
			->setMethods( array( 'fetch' ) )
			->disableOriginalConstructor()
			->getMock();

		$this->dbmStub->expects( $this->once() )->method( 'acquire' )->will( $this->returnValue( $this->mock ) );
		$this->dbmStub->expects( $this->once() )->method( 'release' )->with( $this->equalTo( $this->mock ) );

		$this->mock->expects( $this->once() )->method( 'create' )->will( $this->returnValue( $stmt ) );
		$stmt->expects( $this->once() )->method( 'execute' )->will( $this->returnValue( $result ) );
		$result->expects( $this->once() )->method( 'fetch' )->will( $this->returnValue( false ) );

		$this->assertFalse( $this->object->indexExists( 'testtable', 'testindex' ) );
	}


	public function testConstraintExists()
	{
		$stmt = $this->getMockBuilder( '\Aimeos\MW\DB\Statement\PDO\Simple' )
			->setMethods( array( 'bind', 'execute' ) )
			->disableOriginalConstructor()
			->getMock();

		$result = $this->getMockBuilder( '\Aimeos\MW\DB\Result\PDO' )
			->setMethods( array( 'fetch' ) )
			->disableOriginalConstructor()
			->getMock();

		$this->dbmStub->expects( $this->once() )->method( 'acquire' )->will( $this->returnValue( $this->mock ) );
		$this->dbmStub->expects( $this->once() )->method( 'release' )->with( $this->equalTo( $this->mock ) );

		$this->mock->expects( $this->once() )->method( 'create' )->will( $this->returnValue( $stmt ) );
		$stmt->expects( $this->once() )->method( 'execute' )->will( $this->returnValue( $result ) );
		$result->expects( $this->once() )->method( 'fetch' )->will( $this->returnValue( false ) );

		$this->assertFalse( $this->object->constraintExists( 'testtable', 'testconstraint' ) );
	}


	public function testColumnExists()
	{
		$stmt = $this->getMockBuilder( '\Aimeos\MW\DB\Statement\PDO\Simple' )
			->setMethods( array( 'bind', 'execute' ) )
			->disableOriginalConstructor()
			->getMock();

		$result = $this->getMockBuilder( '\Aimeos\MW\DB\Result\PDO' )
			->setMethods( array( 'fetch' ) )
			->disableOriginalConstructor()
			->getMock();

		$this->dbmStub->expects( $this->once() )->method( 'acquire' )->will( $this->returnValue( $this->mock ) );
		$this->dbmStub->expects( $this->once() )->method( 'release' )->with( $this->equalTo( $this->mock ) );

		$this->mock->expects( $this->once() )->method( 'create' )->will( $this->returnValue( $stmt ) );
		$stmt->expects( $this->once() )->method( 'execute' )->will( $this->returnValue( $result ) );
		$result->expects( $this->once() )->method( 'fetch' )->will( $this->returnValue( false ) );

		$this->assertFalse( $this->object->columnExists( 'testtable', 'testcolumn' ) );
	}


	public function testGetColumnDetails()
	{
		$data = array(
			'TABLE_NAME' => 'testtable',
			'COLUMN_NAME' => 'testcolumn',
			'DATA_TYPE' => 'varchar',
			'CHARACTER_MAXIMUM_LENGTH' => 16,
			'COLUMN_DEFAULT' => 'default',
			'IS_NULLABLE' => 'NO',
		);

		$stmt = $this->getMockBuilder( '\Aimeos\MW\DB\Statement\PDO\Simple' )
			->setMethods( array( 'bind', 'execute' ) )
			->disableOriginalConstructor()
			->getMock();

		$result = $this->getMockBuilder( '\Aimeos\MW\DB\Result\PDO' )
			->setMethods( array( 'fetch' ) )
			->disableOriginalConstructor()
			->getMock();

		$this->dbmStub->expects( $this->once() )->method( 'acquire' )->will( $this->returnValue( $this->mock ) );
		$this->dbmStub->expects( $this->once() )->method( 'release' )->with( $this->equalTo( $this->mock ) );

		$this->mock->expects( $this->once() )->method( 'create' )->will( $this->returnValue( $stmt ) );
		$stmt->expects( $this->once() )->method( 'execute' )->will( $this->returnValue( $result ) );
		$result->expects( $this->once() )->method( 'fetch' )->will( $this->returnValue( $data ) );

		$columnItem = $this->object->getColumnDetails( 'testtable', 'testcolumn' );

		$this->assertEquals( 'testtable', $columnItem->getTableName() );
		$this->assertEquals( 'testcolumn', $columnItem->getName() );
		$this->assertEquals( 'varchar', $columnItem->getDataType() );
		$this->assertEquals( 16, $columnItem->getMaxLength() );
		$this->assertEquals( 'default', $columnItem->getDefaultValue() );
		$this->assertFalse( $columnItem->isNullable() );
	}
}