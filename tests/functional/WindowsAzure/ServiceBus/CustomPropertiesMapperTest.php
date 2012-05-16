<?php

///**
// * Copyright 2011 Microsoft Corporation
// * 
// * Licensed under the Apache License, Version 2.0 (the "License");
// *  you may not use this file except in compliance with the License.
// *  You may obtain a copy of the License at
// *    http://www.apache.org/licenses/LICENSE-2.0
// * 
// *  Unless required by applicable law or agreed to in writing, software
// *  distributed under the License is distributed on an "AS IS" BASIS,
// *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// *  See the License for the specific language governing permissions and
// *  limitations under the License.
// */
//namespace com\microsoft\WindowsAzure\Services\ServiceBus\implementation;
//
//import static org.junit.Assert.*;
//
//import java.text.ParseException;
//import java.util.Calendar;
//import java.util.Date;
//import java.util.TimeZone;
//import java.util.UUID;
//
//import org.junit.Before;
//import org.junit.Test;
//
//class CustomPropertiesMapperTest {
//
//    public function testInit() {
//        $mapper = new CustomPropertiesMapper();
//    }
//
//    public function testStringValuesShouldComeThroughInQuotes() {
//        // Arrange
//
//        // Act
//        $text = $mapper->toString('This is a string');
//
//        // Assert
//        $this->assertEquals('\'This is a string\'', $text, '$text');
//    }
//
//    public function testNonStringValuesShouldNotHaveQuotes() {
//        // Arrange
//
//        // Act
//        $text = $mapper->toString(78);
//
//        // Assert
//        $this->assertEquals('78', $text, '$text');
//    }
//
//    public function testSupportedJavaTypesHaveExpectedRepresentations() {
//        // Arrange
//        $cal = Calendar->getInstance(TimeZone->getTimeZone('GMT'));
//        $cal->set(1971, Calendar->OCTOBER, 14, 12, 34, 56);
//
//        // Act
//
//        // Assert
//        //        $this->assertEquals('78;byte', $mapper->toString((byte) 78), '$mapper->toString((byte) 78)');
//        $this->assertEquals('78', $mapper->toString((byte) 78), '$mapper->toString((byte) 78)');
//        $this->assertEquals('\'a\'', $mapper->toString("a"), '$mapper->toString("a")');
//        $this->assertEquals('-78', $mapper->toString((short) -78), '$mapper->toString((short) -78)');
//        //      $this->assertEquals('78;ushort', $mapper->toString((unsigned short)78, '$mapper->toString((unsigned short)78');
//        $this->assertEquals('-78', $mapper->toString(-78), '$mapper->toString(-78)');
//        //     $this->assertEquals('78;uint', $mapper->toString(78), '$mapper->toString(78)');
//        $this->assertEquals('-78', $mapper->toString((long) -78), '$mapper->toString((long) -78)');
//        //     $this->assertEquals('78;ulong', $mapper->toString(78), '$mapper->toString(78)');
//        $this->assertEquals('78.5', $mapper->toString((float) 78.5), '$mapper->toString((float) 78.5)');
//        $this->assertEquals('78.5', $mapper->toString(78.5), '$mapper->toString(78.5)');
//        //assertEquals('78;decimal', $mapper->toString(78));
//        $this->assertEquals('true', $mapper->toString(true), '$mapper->toString(true)');
//        $this->assertEquals('false', $mapper->toString(false), '$mapper->toString(false)');
//        $this->assertEquals('\'12345678-9abc-def0-9abc-def012345678\'', $mapper->toString(new UUID(0x123456789abcdef0L, 0x9abcdef012345678L)), '$mapper->toString(new UUID(0x123456789abcdef0L, 0x9abcdef012345678L))');
//        $this->assertEquals('\'Thu, 14 Oct 1971 12:34:56 GMT\'', $mapper->toString($cal), '$mapper->toString($cal)');
//        $this->assertEquals('\'Thu, 14 Oct 1971 12:34:56 GMT\'', $mapper->toString($cal->getTime()), '$mapper->toString($cal->getTime())');
//        //assertEquals('78;date-seconds', $mapper->toString(78));
//    }
//
//    public function testValuesComeBackAsStringsWhenInQuotes() {
//        // Arrange
//
//        // Act
//        $value = $mapper->fromString('\'Hello world\'');
//
//        // Assert
//        $this->assertEquals('Hello world', $value, '$value');
//        $this->assertEquals(String->class, $value->getClass(), '$value->getClass()');
//    }
//
//    public function testNonStringTypesWillBeParsedAsNumeric() {
//        // Arrange
//
//        // Act
//        $value = $mapper->fromString('5');
//
//        // Assert
//        $this->assertEquals(5, $value, '$value');
//        $this->assertEquals(Integer->class, $value->getClass(), '$value->getClass()');
//    }
//
//    public function testSupportedFormatsHaveExpectedJavaTypes() {
//        // Arrange
//        $cal = Calendar->getInstance(TimeZone->getTimeZone('GMT'));
//        $cal->set(1971, Calendar->OCTOBER, 14, 12, 34, 56);
//
//        // Act
//        $dt = (Date) $mapper->fromString('\'Thu, 14 Oct 1971 12:34:56 GMT\'');
//
//        // Assert
//        //        $this->assertEquals('78;byte', $mapper->toString((byte) 78), '$mapper->toString((byte) 78)');
//        // $this->assertEquals((byte) 78, $mapper->fromString('78'), '$mapper->fromString(\'78\')');
//        //  $this->assertEquals("a", $mapper->fromString('a;char'), '$mapper->fromString(\'a;char\')');
//        //  $this->assertEquals((short) -78, $mapper->fromString('-78;short'), '$mapper->fromString(\'-78;short\')');
//        //      $this->assertEquals('78;ushort', $mapper->toString((unsigned short)78, '$mapper->toString((unsigned short)78');
//        $this->assertEquals(-78, $mapper->fromString('-78'), '$mapper->fromString(\'-78\')');
//        //     $this->assertEquals('78;uint', $mapper->toString(78), '$mapper->toString(78)');
//        //    $this->assertEquals((long) -78, $mapper->fromString('-78;long'), '$mapper->fromString(\'-78;long\')');
//        //     $this->assertEquals('78;ulong', $mapper->toString(78), '$mapper->toString(78)');
//        //   $this->assertEquals((float) 78.5, $mapper->fromString('78.5;float'), '$mapper->fromString(\'78.5;float\')');
//        $this->assertEquals(78.5, $mapper->fromString('78.5'), '$mapper->fromString(\'78.5\')');
//        //assertEquals('78;decimal', $mapper->toString(78));
//        $this->assertEquals(true, $mapper->fromString('true'), '$mapper->fromString(\'true\')');
//        $this->assertEquals(false, $mapper->fromString('false'), '$mapper->fromString(\'false\')');
//        //    $this->assertEquals(new UUID(0x123456789abcdef0L, 0x9abcdef012345678L, '0x9abcdef012345678L'),
//        //          $mapper->fromString('12345678-9abc-def0-9abc-def012345678;uuid'));
//
//        $this->assertEquals($cal->getTime()->getTime(), $dt->getTime(), 1000);
//        //assertEquals('78;date-seconds', $mapper->toString(78));
//    }
//}
?>
