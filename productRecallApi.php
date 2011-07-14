<?php

class productRecallApi extends APIBaseClass{
	public static $api_url = 'http://search.usa.gov/search/recalls';
	
	// php disallows use of 'sort' as a object parameter name since it is already a common library function name
	public static $param = array('organization'=>'','upc'=>'','sort_by'=>'','code'=>'','make'=>'','model'=>'','year'=>'');
	
	public function __construct($url=NULL)
	{
		parent::new_request(($url?$url:self::$api_url));
	}
	
	/* this api has a lot of options.. so I added an object oriented style of building queries,
	
	  that can be accessed two ways, set_option(option,value) or
	  
	  set_**option name** ($value)
	  
	  set_date(start date, end date)
	  
	  When you're ready to make your query simply call recall_data() or recall_data('search query');
	  
	*/
	public function set_option($option,$value){
		if(array_key_exists($option,self::$param))
			$this->$option =$value;
	}
	// or old school calling
	public function set_org($org){$this->organization = $org;}
	
	public function set_sort($sort_type){ 	$this->sort_by = $sort_type; }
	
	public function set_make($make){		$this->make = $make;		 }
	
	public function set_model($model){		$this->model = $model;		 }
	
	public function set_year($year){		$this->year = $year;		 }
	
	public function set_code($code){		$this->code = $code;		 }
	
	public function set_date($start,$stop=NULL){
	// not to say that start = null is impossible
	// maye want to see that it conforms to the desired timestamp, if not possibly convert it
		$this->start_date = $start;
		if($stop != NULL) $this->end_date = $stop;
	}

	public function recall_data($query=''){
	// step one check for extra options
	// this needs testing ...
	
	
	// we count the total number of object vars, to see if any non default vars have been added to the class,
	// and compare against the count of get_class_vars - which returns an assoc. array of the default class values
		if(count(get_object_vars($this)) > count(get_class_vars())){
			foreach(get_object_vars($this) as $var=>$value)
				if(array_key_exists($var,self::$param) && !$data[$var])
					if($var == 'sort_by')
						$data['sort'] = $value;
					else
						$data[$var] = $value;
			if($data) {
				$data['format'] = 'json';
				return $this->_request($path."$query", 'get' ,$data) ;
				
			}
	
		}
	}


	public function get_recall_data($query,$start_date,$end_date,$options=NULL,$page=1){
	// check if any object params are set, and if so remove start_date end_date etc.
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
		// check for object params
	
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
	
		
		$data = array_merge($data,array_intersect_key($options,array('organization'=>'','upc'=>'','sort'=>'','code'=>'','make'=>'','model'=>'','year'=>''))
	);
		
	return $this->_request($path."$query", 'get' ,$data) ;

	}
	
}
