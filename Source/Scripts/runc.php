<?php
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    
        if (isset($_POST['btnLibPath'])) {
            // btnDelete
            $output = exec(".libpath())", $output, $return);
            //$output = exec("ls -lart");
            echo "<pre>$output</pre>";
    
            if(!$return){echo("called");}
            else{echo("not called");}
        
        } elseif(isset($_POST['btnBoxplot'])) {
            //assume btnSubmit
            $output = exec("unset LD_LIBRARY_PATH; Rscript boxplot.R", $output, $return);
            //$output = exec("ls -lart");
            echo $return;
        }
        
        elseif(isset($_POST['btnScatter'])) {
            //assume btnSubmit
            $output = exec("Rscript scatterPlot.R", $output, $return);
            //$output = exec("ls -lart");
            echo "<pre>$output</pre>";
        }
        
        elseif(isset($_POST['btnSignal'])) {
            //assume btnSubmit
            $output = exec("unset LD_LIBRARY_PATH; Rscript signalkurve.R", $output, $return);
            //$output = exec("ls -lart");
            echo "<pre>$output</pre>";
        }
        
        elseif(isset($_POST['btnHeat'])) {
            //assume btnSubmit
            $output = exec("unset LD_LIBRARY_PATH; Rscript heatmap.R", $output, $return);
            //$output = exec("ls -lart");
            echo "<pre>$output</pre>";
        }
        else{
            echo("F");
        }
    }
    
   
?>