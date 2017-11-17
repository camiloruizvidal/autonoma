<?php

class visual
{

    public static function Tabla($data, $encabezados = array(), $id = '')
    {
        if ($id != '')
        {
            $id = ' id="' . $id . '" ';
        }
        $html = '<table' . $id . ' class="table table-striped table-bordered">' . "\n";
        $html .= '  <thead>' . "\n";
        $html .= '  <tr>' . "\n";
        foreach ($encabezados as $temp)
        {
            $html.='        <th>' . $temp . '</th>' . "\n";
        }
        $html.='    </tr>' . "\n";
        $html.='    </thead>' . "\n";
        $html.='    <tbody>' . "\n";
        for ($i = 0; $i < count($data); $i++)
        {
            $html.='        <tr>' . "\n";
            $html.='            <td>' . ($i + 1) . '</td>' . "\n";
            foreach ($data[$i] as $temp)
            {
                $html.='            <td>' . $temp . '</td>' . "\n";
            }
            $html.='        </tr>' . "\n";
        }
        $html.='    </tbody>' . "\n";
        $html.='</table>';
        return $html;
    }

}
