<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Tests;


use JDWX\HTML5\Elements\Input;
use PHPUnit\Framework\TestCase;


class InputTest extends TestCase {


    public function testChecked() : void {
        $input = new Input();
        self::assertNull( $input->getChecked() );
        $input->setChecked( true );
        self::assertTrue( $input->getChecked() );
        $input->setChecked( false );
        self::assertNull( $input->getChecked() );
        $input->setChecked( 'yes' );
        self::assertTrue( $input->hasChecked() );
        $input->checked( null );
        self::assertNull( $input->getChecked() );
    }


    public function testMax() : void {
        $input = new Input();
        self::assertNull( $input->getMax() );
        $input->setMax( '10' );
        self::assertSame( '10', $input->getMax() );
        $input->setMax( false );
        self::assertNull( $input->getMax() );
        $input->max( 10 );
        self::assertSame( '10', $input->getMax() );
        self::assertTrue( $input->hasMax() );
        $input->max( 4.5 );
        self::assertSame( '4.5', $input->getMax() );
        $input->max( null );
        self::assertNull( $input->getMax() );
        self::assertFalse( $input->hasMax() );
    }


    public function testMaxLength() : void {
        $input = new Input();
        self::assertNull( $input->getMaxLength() );
        self::assertFalse( $input->hasMaxLength() );
        $input->setMaxLength( '10' );
        self::assertSame( '10', $input->getMaxLength() );
        self::assertTrue( $input->hasMaxLength() );
        $input->setMaxLength( false );
        self::assertNull( $input->getMaxLength() );
        $input->maxLength( 10 );
        self::assertSame( '10', $input->getMaxLength() );
        $input->maxLength( null );
        self::assertNull( $input->getMaxLength() );
        self::assertFalse( $input->hasMaxLength() );
    }


    public function testMin() : void {
        $input = new Input();
        self::assertNull( $input->getMin() );
        $input->setMin( '10' );
        self::assertSame( '10', $input->getMin() );
        $input->setMin( false );
        self::assertNull( $input->getMin() );
        $input->min( 10 );
        self::assertSame( '10', $input->getMin() );
        self::assertTrue( $input->hasMin() );
        $input->min( 4.5 );
        self::assertSame( '4.5', $input->getMin() );
        $input->min( null );
        self::assertNull( $input->getMin() );
        self::assertFalse( $input->hasMin() );
    }


    public function testPattern() : void {
        $input = new Input();
        self::assertNull( $input->getPattern() );
        $input->setPattern( 'foo' );
        self::assertSame( 'foo', $input->getPattern() );
        self::assertTrue( $input->hasPattern() );
        $input->setPattern( false );
        self::assertNull( $input->getPattern() );
        $input->pattern( 'foo' );
        self::assertSame( 'foo', $input->getPattern() );
        $input->pattern( null );
        self::assertNull( $input->getPattern() );
        self::assertFalse( $input->hasPattern() );
    }


    public function testSize() : void {
        $input = new Input();
        self::assertNull( $input->getSize() );
        self::assertFalse( $input->hasSize() );
        $input->setSize( '10' );
        self::assertSame( '10', $input->getSize() );
        self::assertTrue( $input->hasSize() );
        $input->setSize( false );
        self::assertNull( $input->getSize() );
        $input->size( 10 );
        self::assertSame( '10', $input->getSize() );
        $input->size( null );
        self::assertNull( $input->getSize() );
        self::assertFalse( $input->hasSize() );
    }


}
