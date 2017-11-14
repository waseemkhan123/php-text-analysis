<?php

namespace Tests\TextAnalysis\Sentiment;

use TextAnalysis\Sentiment\Vader;

/**
 *
 * @author yooper
 */
class VaderTest extends \PHPUnit_Framework_TestCase
{
    public function testGetDataSet()
    {       
        if( getenv('SKIP_TEST')) {
            return;
        }
        
        $vader = new Vader;
        $this->assertCount(7503, $vader->getDataSet());        
    }
    
    public function testAllCapDifferential()
    {
        $vader = new Vader;
        $this->assertFalse($vader->allCapDifferential(['alright', 'no', 'caps']));
        $this->assertFalse($vader->allCapDifferential(['ALL', 'CAPS']));
        $this->assertTrue($vader->allCapDifferential(['some', 'CAPS']));        
    }
    
    public function testIsNegated()
    {
        $vader = new Vader;
        $this->assertFalse($vader->isNegated(['that','did','it']));
        $this->assertTrue($vader->isNegated(['that', 'didn\'t', 'it']));
        $this->assertTrue($vader->isNegated(['that', 'winn\'t', 'it']));                
    }
    
    public function testBoostExclamationPoints()
    {
        $vader = new Vader;        
        $this->assertEquals(0, $vader->boostExclamationPoints(['empty']));
        $this->assertEquals(0.292, $vader->boostExclamationPoints(array_fill(0,1,'!')));
        $this->assertEquals(0.584, $vader->boostExclamationPoints(array_fill(0,2,'!')));
        $this->assertEquals(0.876, $vader->boostExclamationPoints(array_fill(0,3,'!')));
        $this->assertEquals(1.168, $vader->boostExclamationPoints(array_fill(0,4,'!')));        
        $this->assertEquals(1.168, $vader->boostExclamationPoints(array_fill(0,5,'!')));               
    }
    
    
    public function testBoostQuestionMarks()
    {
        $vader = new Vader;        
        $this->assertEquals(0, $vader->boostQuestionMarks(['empty']));
        $this->assertEquals(0, $vader->boostQuestionMarks(array_fill(0,1,'?')));
        $this->assertEquals(0.36, $vader->boostQuestionMarks(array_fill(0,2,'?')));
        $this->assertEquals(0.54, $vader->boostQuestionMarks(array_fill(0,3,'?')));
        $this->assertEquals(0.96, $vader->boostQuestionMarks(array_fill(0,4,'?')));        
        $this->assertEquals(0.96, $vader->boostQuestionMarks(array_fill(0,5,'?')));               
    }
    
    public function testButCheck()
    {
        $vader = new Vader;        
        
    }
        
}
