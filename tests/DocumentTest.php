<?php declare( strict_types = 1 );


require_once __DIR__ . '/MyTestCase.php';


use JDWX\HTML5\Document;
use JDWX\HTML5\Elements;


/**
 * Class DocumentTest
 *
 * @package JDWX\HTML5\Tests
 * @covers \JDWX\HTML5\Document
 * @covers \JDWX\HTML5\AbstractDocument
 * @covers \JDWX\HTML5\Element
 * @covers \JDWX\HTML5\Elements\A
 * @covers \JDWX\HTML5\Elements\Body
 * @covers \JDWX\HTML5\Elements\HTML
 * @covers \JDWX\HTML5\Elements\Head
 * @covers \JDWX\HTML5\Elements\Link
 * @covers \JDWX\HTML5\Elements\Meta
 * @covers \JDWX\HTML5\Elements\P
 * @covers \JDWX\HTML5\Elements\Title
 */
class DocumentTest extends MyTestCase {


    /** @noinspection HtmlUnknownTarget */
    public function testAddToTitleWithNoTitle() : void {
        $doc = new Document();
        $doc->appendToTitle( 'Example Title' );
        $stExpect = '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><title>Example Title</title></head><body></body></html>';
        self::assertEquals( $stExpect, ( string ) $doc );
    }


    public function testDocument() : void {

        $doc = new Document();
        $doc->setTitle( 'Example' );
        $doc->appendToTitle( ' Title' );
        $doc->addCSSFile( 'test.css' );
        $doc->body()->setClass( 'foo' );

        $a = new Elements\A( $doc, 'href', 'title', 'link' );
        $p = new Elements\P( $doc, 'text' );
        $doc->appendChild( 'This is a test.', $a, $p );
        $doc->addIconFile( 'favicon.ico' );

        $stHead = '<head><meta charset="UTF-8"><title>Example Title</title><link href="test.css" rel="stylesheet" type="text/css"><link href="favicon.ico" rel="icon" type="image/vnd.microsoft.icon"></head>';
        self::assertEquals( $stHead, ( string ) $doc->head() );

        $stExpect = '<!DOCTYPE html><html lang="en">' . $stHead . '<body class="foo">This is a test.<a href="href" title="title">link</a><p>text</p></body></html>';
        self::assertEquals( $stExpect, (string) $doc );

        $stTidy = '<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>
      Example Title
    </title>
    <link href="test.css" rel="stylesheet" type="text/css">
    <link href="favicon.ico" rel="icon" type="image/vnd.microsoft.icon">
  </head>
  <body class="foo">
    This is a test.<a href="href" title="title">link</a>
    <p>
      text
    </p>
  </body>
</html>';
        self::assertEquals( $stTidy, $doc->tidy() );

    }


}



