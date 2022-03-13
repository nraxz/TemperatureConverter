<?php

namespace App\Converter;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class TemperatureConverter extends Command
{
    
    public $response;    
    
    protected function configure(): void
    {
        $this->setName('convert');               
        $this->addArgument('temperature', InputArgument::REQUIRED, 'Temperature to convert');
       
        
    }

    public function __construct()
    {
        parent::__construct();
    }
    

     /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $temp = $input->getArgument('temperature');
        $result = $this->convert($input->getArgument('temperature'));
        $output->write($temp. ' is converted to '. $result);
        return 200;
        
    }

    public function convert($input)
    {
        
        $dtemp = $this->sanitization($input); // Delta Temp
        
        $temp = $dtemp[0];
        $unit = $dtemp[1];  
        if(is_numeric($temp) == 0)
        {
            $this->response = 'Invalid Tempreture Value';
        }    
        else
        {

            /*Two more cases implemented for accepting negetive values*/
            
            switch ($unit) {
                case 'C':
                $this->toFahrenheit($temp);
                break;
                case 'F':
                $this->toCelsius($temp);
                break;
                case 'C-':                    
                    $ntemp = $temp * -1;
                    $this->toFahrenheit($ntemp);
                    break;
                case 'F-':
                    $ntemp = $temp * -1;
                    $this->toCelsius($ntemp);
                    break;
                
                default:
                $this->response = 'Error Message: Invalid Temperature value or unit missing.';
            }
        }      

        
        return $this->response;
    }
    private function sanitization($input)
    {
        $value = array(); 
        $str = preg_split('/(?<=[0-9])(?=[a-z]+)/i', $input);
        array_push($value, $str[0]);
        array_push($value, strtoupper($str[1])); //This will avoid possible error could caused by unit case sensitive.    
        return $value;
       
    }

    private function toFahrenheit($temp)
    {
        $new_temp = ($temp * 9 / 5) + 32;
        $this->response = $new_temp . ' Fahrenheit';
    }

    private function toCelsius($temp)
    {
        $new_temp = ($temp - 32) * 5 / 9;
        $this->response = $new_temp . ' Celsius';
    }
}