
<?php
const MAX_ITERATIONS = 20;
$i = 1;

//Os bucles non marcan un ámbito local propio(só funcións e clases)
while ($i <MAX_ITERATIONS) {
   //Opción 1:   
    echo "<p>". $i++."</p>";   
    $j=$i;
   
}

// while ($i <MAX_ITERATIONS) {
//     //Opción 2 (válida):   
    
//      echo "<p> $i</p>";  
//      $i++;   
//      $j=$i;
    
//  }

//  while ($i <MAX_ITERATIONS) {
//     //Opción 3: No es fiel al espíritu del enciado.
//Varía el valor de $j (19 en lugar de 20)  
//     //En la asignación, primero se asigna $i a $j y posteriormente se incrementa $i
//      echo "<p> $i</p>";     
//      $j=$i++;
//     //  echo "<p> \$j es $j</p>";
//     //  echo "<p> \$i es $i</p>";
    
//  }

echo "<p> \$j vale $j</p>";
