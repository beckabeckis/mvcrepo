<?php

namespace App\Test\Entity;

use App\Entity\Library;
use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Library.
 */
class LibraryTest extends TestCase
{
    /**
     * Construct object and verify getId method is working.
     */
    public function testId(): void
    {
        $library = new Library();
        $this->assertInstanceOf("\App\Entity\Library", $library);

        $res = $library->getId();
        $this->assertEmpty($res);
    }

    /**
     * Construct object and verify getTitle and setTitle method is working.
     */
    public function testTitle(): void
    {
        $library = new Library();
        $this->assertInstanceOf("\App\Entity\Library", $library);

        $res = $library->setTitle("Test Title");
        $exp = "Test Title";
        $this->assertInstanceOf("\App\Entity\Library", $res);

        $res = $library->getTitle();
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and verify getIsbn and setIsbn method is working.
     */
    public function testIsbn(): void
    {
        $library = new Library();
        $this->assertInstanceOf("\App\Entity\Library", $library);

        $res = $library->setIsbn("Test Isbn");
        $exp = "Test Isbn";
        $this->assertInstanceOf("\App\Entity\Library", $res);

        $res = $library->getIsbn();
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and verify getAuthor and setAuthor method is working.
     */
    public function testAuthor(): void
    {
        $library = new Library();
        $this->assertInstanceOf("\App\Entity\Library", $library);

        $res = $library->setAuthor("Test Author");
        $exp = "Test Author";
        $this->assertInstanceOf("\App\Entity\Library", $res);

        $res = $library->getAuthor();
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and verify getImgLink and setImgLink method is working.
     */
    public function testImgLink(): void
    {
        $library = new Library();
        $this->assertInstanceOf("\App\Entity\Library", $library);

        $res = $library->setImgLink("Test ImgLink");
        $exp = "Test ImgLink";
        $this->assertInstanceOf("\App\Entity\Library", $res);

        $res = $library->getImgLink();
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and verify getDetails and setDetails method is working.
     */
    public function testDetails(): void
    {
        $library = new Library();
        $this->assertInstanceOf("\App\Entity\Library", $library);

        $res = $library->setDetails("Test Details");
        $exp = "Test Details";
        $this->assertInstanceOf("\App\Entity\Library", $res);

        $res = $library->getDetails();
        $this->assertEquals($exp, $res);
    }
}
