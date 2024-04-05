<?php
class FPDF_CellFit extends FPDF
{
    function CellFit($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false)
    {
        if(!isset($this->CurrentFont))
            $this->Error('No font has been set');
        
        $k = $this->k;
        $cw = &$this->CurrentFont['cw'];
        
        if($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        
        if($nb > 0 && $s[$nb - 1] == "\n")
            $nb--;
        
        $b = 0;
        if($border)
        {
            if($border == 1)
            {
                $border = 'LTRB';
                $b = 'LRT';
                $b2 = 'LR';
            }
            else
            {
                $b2 = '';
                if(strpos($border, 'L') !== false)
                    $b2 .= 'L';
                if(strpos($border, 'R') !== false)
                    $b2 .= 'R';
                $b = (strpos($border, 'T') !== false) ? $b2.'T' : $b2;
            }
        }
        
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        
        while($i < $nb)
        {
            // Get next character
            $c = $s[$i];
            if($c == "\n")
            {
                // Explicit line break
                if($this->ws > 0)
                {
                    $this->ws = 0;
                    $this->_out('0 Tw');
                }
                $this->Cell($w, $h, substr($s, $j, $i - $j), $b, 2, $align, $fill);
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                if($border && $nl == 2)
                    $b = $b2;
                continue;
            }
            if($c == ' ')
            {
                $sep = $i;
            }
            $l += $this->GetStringWidth($c);
            if($l > $wmax)
            {
                // Automatic line break
                if($sep == -1)
                {
                    if($i == $j)
                        $i++;
                }
                else
                    $i = $sep + 1;
                if($this->ws > 0)
                {
                    $this->ws = 0;
                    $this->_out('0 Tw');
                }
                $this->Cell($w, $h, substr($s, $j, $i - $j), $b, 2, $align, $fill);
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                if($border && $nl == 2)
                    $b = $b2;
            }
            else
                $i++;
        }
        // Last chunk
        if($this->ws > 0)
        {
            $this->ws = 0;
            $this->_out('0 Tw');
        }
        if($border && strpos($border, 'B') !== false)
            $b .= 'B';
        $this->Cell($w, $h, substr($s, $j, $i - $j), $b, 2, $align, $fill);
        $this->x = $this->lMargin;
    }
}