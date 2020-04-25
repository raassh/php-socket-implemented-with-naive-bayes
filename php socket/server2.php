<?php
class server_socket{              
    var $host;       
    var $port;         
    var $buffer;        
    var $connected;         
    var $bind_result;        
    var $lstn_result;         
    var $newSocket;         
    var $to_client;         
    var $from_client;         
    var $writeLen;                  
    
    function __construct($host="127.0.0.1",$port=9001,$max=0){             
        $this->host      = $host;            
        $this->port      = $port;             
        $this->buffer    = 1024;             
        $this->connected = false;             
        echo " Start listening... \n\r";             
        $this->server_created_socket();         
    }                  
    
    public function server_created_socket(){             
        set_time_limit(0);             
        $this->connected = socket_create(AF_INET,SOCK_STREAM,0) or die("Could not create a socket");             
        if($this->connected){                 
            $this->bind_result= socket_bind($this->connected,$this->host,$this->port) or die('could not bind to port');                 
                if($this->bind_result){
                    $this->lstn_result= socket_listen($this->connected,3) or die('unable to listen');
                    $this->open_listening();
                }
        }
        else{
            self::__construct();
        }
    }
    
    private function listen_loop(){
            $this->newSocket    = socket_accept($this->connected);             
            if($this->newSocket) return true;            
            else return false;         
    }
    
    public function open_listening(){
        $this->listen_loop();
        $this->from_client  = socket_read($this->newSocket,$this->buffer);            
        $this->from_client  = trim($this->from_client);         
        $this->str_cmd[date('Y-m-d h:i:s')]='';      
        if($this->from_client){
            $this->str_cmd[date('Y-m-d h:i:s')]  = $this->from_client; 
            self::write_callback_toclient();
            self::console();  
            socket_set_block($this->connected);  
                if(!$this->connected) $this->server_created_socket(); 
                $this->server_created_socket();
        }
    }
    
    function write_callback_toclient(){
        $this->to_client = $this->from_client;
        $this->writeLen  = socket_write($this->newSocket,$this->to_client,strlen($this->to_client)) or die('unable to write');
    }
    
    public function console(){
    
        if(is_array($this->str_cmd)){
            $n=0;
            foreach($this->str_cmd as $key=>$value){
                echo "[".$key."] :".$value." \n\r";
                $n++;
            }
        }
    }
 }
  
  ob_implicit_flush(true);     
  $ok = new server_socket($host="127.0.0.1",$port=9001,$max=0);
 
?>