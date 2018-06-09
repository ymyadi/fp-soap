<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Eloquent\Mesin;
use DB;

class AbsenLog extends Model
{
    use SoftDeletes;
    protected $table = 'absen_log';
    protected $primaryKey = 'absen_log_id';
    protected $fillable = ['pin', 'date_time', 'ver', 'status_absen_id', 'mesin_id'];
    protected $dates = ['deleted_at'];

    public function statusAbsen() {
        return $this->belongsTo('App\Eloquent\StatusAbsen', 'status_absen_id');
    }

    public function syncData() {
      try {
        $return = FALSE;
        $mesin = Mesin::where('is_default', 1);
        if($mesin->count() > 0):
            $IP = $mesin->first()->ip;
            $Key = $mesin->first()->password;
            $port = $mesin->first()->port;
            if($IP != "") {
                $Connect = fsockopen($IP, $port, $errno, $errstr, 1);
                if($Connect) {
                    $soapRequest = "<GetAttLog><ArgComKey xsi:type=\"xsd:integer\">" . $Key . "</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
                    $newLine = "\r\n";
                    fputs($Connect, "POST /iWsService HTTP/1.0" . $newLine);
                    fputs($Connect, "Content-Type: text/xml" . $newLine);
                    fputs($Connect, "Content-Length: " . strlen($soapRequest) . $newLine . $newLine);
                    fputs($Connect, $soapRequest . $newLine);
                    $buffer = "";
                    while($Response = fgets($Connect, 1024)) {
                        $buffer = $buffer . $Response;
                    }
                    $buffer = parse_data($buffer, "<GetAttLogResponse>","</GetAttLogResponse>");
                    $buffer = explode("\r\n", $buffer);
                    for($i = 0; $i < count($buffer); $i++){
                        $data = parse_data($buffer[$i], "<Row>", "</Row>");
                        $PIN = parse_data($data, "<PIN>", "</PIN>");
                        $DateTime = parse_data($data, "<DateTime>", "</DateTime>");
                        $Verified = parse_data($data, "<Verified>", "</Verified>");
                        $Status = parse_data($data, "<Status>", "</Status>");
                        $cekDataAbsen = AbsenLog::where('pin', $PIN)->where('date_time', $DateTime)->count();
                        if ($cekDataAbsen > 0 && $PIN && $DateTime) {
                            $absen = new AbsenLog();
                            $absen->pin = $PIN;
                            $absen->mesin_id = $mesin->first()->mesin_id;
                            $absen->date_time = $DateTime;
                            $absen->ver = $Verified;
                            $absen->status_absen_id = UNPROCESSED;
                            $absen->save();
                        }
                    }
                    if($buffer) {
                        $return = TRUE;
                    } else {
                        $return = FALSE;
                    }
                }
            }
        endif;
      } catch (\Exception $e) {
        $return = FALSE;
      }
      return $return;
    }

    public function getSummaryDataLogAbsensi($month, $year) {
        return DB::table($this->table)
        ->select(DB::raw("pin,MIN(date_time) AS check_in,MAX(date_time) AS check_out,
        IF(MIN(date_time) = MAX(date_time), 'FALSE', 'TRUE') AS valid,
        (time_to_sec(timediff(MAX(date_time), MIN(date_time))) / 3600) as work_hours"))
        ->whereMonth('date_time', '=', $month)
        ->whereYear('date_time', '=', $year)
        ->where('status_absen_id', '=', 2)
        ->groupBy(DB::raw("pin, DATE_FORMAT(date_time, '%Y-%m-%d')"))
        ->orderBy(DB::raw("DATE_FORMAT(date_time, '%Y-%m-%d'), pin"))
        ->get();
    }

    public function updateProcessed($month, $year) {
        DB::table($this->table)
        ->whereMonth('date_time', '=', $month)
        ->whereYear('date_time', '=', $year)
        ->update(['status_absen_id' => 1]);
    }
}
