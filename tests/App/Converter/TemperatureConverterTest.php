<?php
namespace App\Converter;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;
use App\Converter\TemperatureConverter;

class TemperatureConverterTest extends TestCase
{
   
     /**
     * @param $input     
     * @param $expectedResult
     *
     * @dataProvider converterDataProvider
     */
    public function testConvert($input)
    {
        $converter = new CommandTester(new TemperatureConverter());

        $options = [
            'temperature' => $input,
        ];
       
        $converter->execute($options);
        $tc = new TemperatureConverter();
        $result = $tc->convert($input);
        $expectedResult = $input. ' is converted to '. $result;
        // var_dump($converter->getDisplay());
       
       $this->assertEquals($expectedResult, $converter->getDisplay());

    }

    public function converterDataProvider()
    {
        return [
            ['20c', '20c is converted to 68 Fahrenheit'],
            ['20f', '20f is converted to -6.6666666666667 Celsius'],  
            ['25C-', '25C- is converted to -13 Fahrenheit'],       
            ['25F-', '25F- is converted to -31.666666666667 Celsius'],
            ['98.8F', '98.8F is converted to 37.111111111111 Celsius'],
            ['98.88C', '98.88C is converted to 209.84 Fahrenheit'],                    

        ];
        
    }    

}