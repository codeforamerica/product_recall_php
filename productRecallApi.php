<?php

class productRecallApi extends APIBaseClass{
	// supports json only... don't include format, _request should handle it
	
	// api_key , query, start_date , end_date , organization, upc, sort , code, make, model, year, page
	
	public static $api_url = 'http://search.usa.gov/search/recalls';
	
	public function __construct($url=NULL)
	{
		parent::new_request(($url?$url:self::$api_url));
	}
	
	public function get_recall_data($query,$start_date,$end_date,$options=NULL,$page=1){
	// ideally some options should be required but documentation doesn't make which ones those are clear
	/*	Product Recall Data API
		Parameters:
		
		    api_key: your API key. You can get a key by signing up for an account.
		        Example: http://search.usa.gov/search/recalls?api_key=9c63bbbfcd985314b245ef92ab37a792
		    format: json. This parameter is required. The most recent recalls are returned as the default if no other parameters are given.
		        Example: http://search.usa.gov/search/recalls?format=json
		    query: keywords. Query terms for the search.
		        Example: http://search.usa.gov/search/recalls?query=tires&format=json
		    start_date: yyyy-mm-dd. Start date of the recall.
		        Example: http://search.usa.gov/search/recalls?start_date=2010-01-01&end_date=2010-03-19&format=json
		    end_date: yyyy-mm-dd. End date of the recall.
		        Example: http://search.usa.gov/search/recalls?start_date=2010-01-01&end_date=2010-03-19&format=json
		    organization: Government organization providing the recall data. Valid values are: (1) NHTSA. National Highway Traffic Safety Administration; (2) CPSC. Consumer Product Safety Commission; or (3) CDC. Centers for Disease Control and Prevention. Values must be entered in all caps.
		        Example: http://search.usa.gov/search/recalls?format=json&organization=CDC
		    upc: UPC code. This parameter is only relevant for Product Safety. Not all products have UPC code.
		        Example: http://search.usa.gov/search/recalls?upc=3826959035 &format=json
		    sort: Sort order. Add Ò&sort=dateÓ to sort by date, or leave blank to sort by relevance.
		        Example: http://search.usa.gov/search/recalls?format=json&organization=CDC&sort=date
		    code: NHTSA code for auto recalls. Valid values are E, V [for vehicles], I, T, C, or X. Values are single letters, which must be entered in all caps.
		        Example: http://search.usa.gov/search/recalls?format=json&make=Toyota&code=V
		    make: NHTSA make information for auto recalls.
		        Example: http://search.usa.gov/search/recalls?format=json&make=Toyota
		    model: NHTSA model information for auto recalls.
		        Example: http://search.usa.gov/search/recalls?format=json&model=Camry
		    year: yyyy. NHTSA year information for auto recalls.
		        Example: http://search.usa.gov/search/recalls?format=json&year=2002
		    page: Pagination of search results. Ten results are displayed on each search results page. Paginate search results pages by adding '&page=#' to the query string.
		        Example: http://search.usa.gov/search/recalls?format=json&page=3
	*/
	
		$data['format'] = 'json';
		$data['page'] = $page;
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		
		$data = array_merge($data,array_intersect_key($options,array('organization'=>'','upc'=>'','sort'=>'','code'=>'','make'=>'','model'=>'','year'=>''))
	);
		
		// use some kind of array intersects function

	return $this->_request($path."$query", 'get' ,$data) ;

	}
	
	}
