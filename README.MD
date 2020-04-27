# Laravel Project to collect data 


This is a laravel project to collect data from https://github.com/CSSEGISandData/COVID-19

## Data Source 
https://github.com/CSSEGISandData/COVID-19

## Artisan Commands
<b>Pull total Report Case</b><br/>
PHP artisan  pull_case_data:pull pull start_date end_date <br/>
This command will pull the total case data from https://github.com/CSSEGISandData/COVID-19 the 
date start_date and end_date in m-d-Y format.
<br>if do not sepcify the start date, then the default start date will be 01-22-2020<br>

<b>Dispatch Update Daily Case Job</b><br/>
PHP artisan  pull_case_data:pull dispatch start_date end_date <br/>
This command will update daily confirmed, deaths, recovered, active data compare with last date data
start_date and end_date in m-d-Y format.
<br>if do not sepcify the start date, then the default start date will be 01-22-2020<br>


## Terms of Use
This GitHub repo and its contents herein, including all data, mapping, and analysis,  is provided to the public strictly for educational and academic research purposes.The project relies upon publicly available data from multiple sources, that do not always agree. Project owner(Zhengguotong)  hereby disclaims any and all representations and warranties with respect to the data, including accuracy, fitness for use, and merchantability.  Reliance on the Website for medical guidance or use of the Website in commerce is strictly prohibited.
