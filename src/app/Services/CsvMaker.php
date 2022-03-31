<?php
namespace App\Services\CsvMaker;

use App\Exceptions\EmptyCsvDownloadException;
use App\Exceptions\EncodingCsvDownloadException;

/**
 * CSVダウンロードサービス
 * CSV download service
 * @author sekiguchi
 */
class CsvMaker
{
    /**
     * ファイル名
     * file name
     */
    protected $fileName = '';

    /**
     * 項目名データ(1行目)
     * Item name data (1st line)
     */
    protected $csvHeader = [];

    /**
     * CSVデータ(2行目以降)
     * CSV data (from the second line)
     */
    protected $csvData = [];


    public function download($csvData)
    {
        $this->setCsvData($csvData);
        return $this->streamDownload();
    }

    /**
     * Description
     * @return type
     */
    protected function streamDownload()
    {
        $csv_header = $this->csvHeader;
        $csv_data   = $this->csvData;

        if (empty($csv_header) && empty($csv_data)) {
            throw new EmptyCsvDownloadException();
        }

        if (count($csv_header) > 0) {
            $csv_header = $this->convertEncoding($csv_header); // SJIS-win
        }
        if (count($csv_data) > 0) {
            foreach ($csv_data as &$row) {
                $row = $this->convertEncoding($row); // SJIS-win
                $row = $this->convertCommaDoubleByte($row); // 半角カンマを全角へ変換
                $row = $this->deleteCRLF($row); // 改行を削除
            }
            unset($row);
        }

        $callback = function () use ($csv_data, $csv_header) {
            $fp = fopen('php://output', 'w');
            fputcsv($fp, $csv_header);
            foreach ($csv_data as $row) {
                fputcsv($fp, $row);
            }
            fclose($fp);
        };

        return response()->streamDownload($callback, $this->makeFileName($this->fileName).'.csv', $this->responseHeaders($this->fileName));
    }

    /**
     * ヘッダー取得
     * Get header
     * @param  String $fileName
     * @return Array
     */
    private function responseHeaders(String $fileName)
    {
        return [
                'Cache-Control'             => 'must-revalidate, post-check=0, pre-check=0'
            ,   'Content-type'              => 'text/csv charset=SJIS-win'
            ,   'Content-Disposition'       => 'attachment; filename=' . $this->makeFileName($fileName) . '.csv'
            ,   'Content-Transfer-Encoding' => 'binary'
            ,   'Expires'                   => '0'
            ,   'Pragma'                    => 'public'
        ];
    }

    /**
     * ファイル名取得
     * {指定のファイル名} + {タイムスタンプ}.csv
     * File name acquisition
     * {Specified file name} + {timestamp}.csv
     * @param  String $fileName
     * @return String
     */
    private function makeFileName(String $fileName)
    {
        return $fileName.'_'.time();
    }

    /**
     * Shift-jis に変換
     * Convert to Shift-jits
     * @param  Array  $record
     * @return Array  $record
     */
    private function convertEncoding(Array $record)
    {
        $code = mb_convert_variables('SJIS-win', 'UTF-8', $record);
        if ($code === false) {
            throw new EncodingCsvDownloadException();
        }
        return $record;
    }

    /**
     * 半角カンマ「,」がある場合、全角カンマ「，」へ変換
     * If there is a single-byte comma 「,」, convert it to a double-byte comma 「，」
     * @param  Array  $record
     * @return Array  $result
     */
    private function convertCommaDoubleByte(Array $record)
    {
        $result = [];
        foreach ($record as $column) {
            $result[] = str_replace(',', '，', $column);
        }
        return $result;
    }

    /**
     * 改行がある場合、削除
     * Delete if there is a line break
     * @param  Array  $record
     * @return Array  $result
     */
    private function deleteCRLF(Array $record)
    {
        $result = [];
        foreach ($record as $column) {
             // すべての改行コードに対応していることを明確にするため、あえて全部記載している。
             // TODO なぜか効かないがCSVファイル上では\nという文字として扱われているため、今のところ問題なし。いずれ修正したい
             // To make it clear that all line feed codes are supported, they are all listed here.
            $result[] = str_replace(["\r\n", "\r", "\n"], '', $column);
        }
        return $result;
    }
}
