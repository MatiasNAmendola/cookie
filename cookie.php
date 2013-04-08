<?php

namespace Blacksmith;

class Cookie
{
	
	protected $_cookie_name 	= 'bs_cookie';
	protected $_cookie_path   = '';
	protected $_cookie_expire = 7200;
	protected $_cookie_secure = FALSE;
	protected $_cookie_http   = FALSE;
	protected $_serlized      = FALSE;
	
	public function __construct(array $config = array())
	{
		$this->_cookie_name   = isset($config['cookie_name']) ? $config['cookie_name'] : "";
		$this->_cookie_path   = isset($config['cookie_path']) ? $config['cookie_path'] : "";
		$this->_cookie_expire = isset($config['cookie_expire']) ? $config['cookie_expire'] : ""; 
		$this->_cookie_secure = isset($config['cookie_secure']) ? $config['cookie_secure'] : ""; 
		$this->_cookie_http   = isset($config['cookie_http_only']) ? $config['cookie_http_only'] : ""; 
	}
	
	public function set($data , $name = NULL)
	{
		if(\is_array($data))
		{
			$data = \serialize($data);
			$this->_serlized = TRUE;
		}
		
		if($name !== NULL or !\is_bool($name) or $name !== '')
		{
			$this->_cookie_name = $name;
		}
		
		return \setcookie(
						 $this->_cookie_name, 
						 $data, 
						 $this->_cookie_expire,
						 $this->_cookie_path, 
						 '', 
						 $this->_cookie_secure, 
						 $this->_cookie_http
						);
	}
	
	public function get($name = NULL)
	{
		if($name !== NULL or !\is_bool($name) or $name !== '')
		{
			$this->_cookie_name = $name;
		}
		
		if($this->_serlized === TRUE)
		{
			if(isset($_COOKIE[$this->_cookie_name]))
			{
				return \unserialize($_COOKIE[$this->_cookie_name]);
			}
			
			else
			{
				return FALSE;
			}
		}
		
		return $_COOKIE[$this->_cookie_name];
	}
	
	public function clean($name = NULL)
	{
		if($name !== NULL or !\is_bool($name) or $name !== '')
		{
			$this->_cookie_name = $name;
		}
		
	
		if(isset($_COOKIE[$this->_cookie_name]))
		{
			unset($_COOKIE[$this->_coookie_name]);
			return TRUE;
		}
		
		return FALSE;
	}
	
	public function flush()
	{
		return $_COOKIE;
	}
	
	public function destory()
	{
		$_COOKIE = array();
	}
	
	
	 
}

?>