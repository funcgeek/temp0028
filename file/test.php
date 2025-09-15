
<?php
    function getPrinters()
    {
        exec('lpstat -a | awk \'{print $1}\'', $out);

        return is_array($out) ? $out : [];
    }

echo getPrinters();
?>
