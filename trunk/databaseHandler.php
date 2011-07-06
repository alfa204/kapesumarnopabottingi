<?php
class DatabaseHandler {
    // ATTRIBUTE
    // konfigurasi setting database
    public $sqlUsername     = 'testin75_root';
    public $sqlPassword     = 'root123';
    public $sqlURL          = 'box9.host1free.com';
    public $sqlDBName       = 'testin75_POIDB';
    // atribut koneksi dengan database
    public $sqlSelectedConn;
    public $sqlSelectedDB;
    // nama tabel yang akan digenerate
    public $t_poiuser       = 'user_table';
    public $t_poi           = 'poi_table';
    public $t_poilayar      = 'poilayar_table';
    public $t_tagline       = 'tagline_table';
    public $t_waktutayang   = 'waktutayang_table';
    
    // METHOD
    // konstruktor
    public function __construct() {
        $this->sqlSelectedConn = mysql_connect($this->sqlURL, $this->sqlUsername, $this->sqlPassword) or die("Can't Connect Database");
        if ($this->sqlSelectedConn) {
            $this->sqlSelectedDB = mysql_select_db($this->sqlDBName, $this->sqlSelectedConn) or die("Can't Select Database");
            if ($this->sqlSelectedDB) {
                // berhasil konek
            }
        }
    }

    // generate query
    public function execQuery($query) {
        return mysql_query($query);
    }
}
?>