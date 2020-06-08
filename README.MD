# Laravel Project to collect data 


This is a laravel project to collect data from https://github.com/CSSEGISandData/COVID-19

## Data Source 
https://github.com/CSSEGISandData/COVID-19

## Docker Configuration

### .env
Create an `.env` file from `.env.example`
```bash
cp .env.example .env

# Customize every variable according to your needs
# See comments to each variable in .env.example file
```
### Docker Containers list 
- covid_19_data_laravel_fpm   PHP FPM container 
- covid_19_data_laravel_nginx Nginx Container
- covid_19_data_laravel_db DD Conatiner  
- covid_19_data_laravel_redis Redis container

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

## API Endpoint
<b>Total Report Case</b><br/>
###### /api/reported-cases<br/>
Get All reported case for each country/region, province, admin2

###### /api/search/reported-cases<br/>
Search lastest reporeted by country/region, province, amdin2 <br>
eg.
- /api/search/reported-cases?country=US&admin2=Choctaw  Search current reported case on Choctaw US
- /api/search/reported-cases?country=Australia&province=Queensland Search current reported case on Queesland Australia


## Terms of Use
This GitHub repo and its contents herein, including all data, mapping, and analysis,  is provided to the public strictly for educational and academic research purposes.The project relies upon publicly available data from multiple sources, that do not always agree. Project owner(Zhengguotong)  hereby disclaims any and all representations and warranties with respect to the data, including accuracy, fitness for use, and merchantability.  Reliance on the Website for medical guidance or use of the Website in commerce is strictly prohibited.
