<?php
/**
 * This algorithm inserts a sorted list of elements into a binary tree to produce a balanced
 * binary tree.
 * This means, to cost of insertion will be O(nlogn) instead of O(n2) for unbalance binary trees.
 * Please help imporve it or leave a thank you
 * @author Levi Kamara Zwannah
 * @version 1. 0
 * 
 */

 require_once('binaryTree.php');

/**
 * This function inserts a sorted array with integer index into a binary tree.
 * To maintain a space complexity of O(n) where n is the array size, you should unset the index 
 * after it is been inserted into the binary tree.
 * Here the array is passed by reference, so any changes in this function will affect the actual array.
 * Also, the loop in this function runs for n times. Therefore total complexity is nlogn
 */
 function InsertIntoBinaryTree(BinarySearchTree &$bintree, array &$sortedArray)
 {
    $size = count($sortedArray);
    $jump_factor = 2 ** floor(log($size, 2)); // jump_factor will select which elements get inserted.
    $prev_jf = $jump_factor; //previous jump_factor will take note of the last jump factor so that
    //no element get inserted twice.

    $step_counter = 0;

    do{
        for($i = $jump_factor; ($i - 1) < $size; $i += $prev_jf){
            $step_counter++;
            $node = new BinarySearchNode($sortedArray[$i - 1]);
            //unset the index to maintain space complexity
            unset($sortedArray[$i - 1]);

            //insert into Binary tree logn complexity
            $bintree->insert($node);
        }
        //update jump and previous jumpfactor
        $prev_jf = $jump_factor;
        $jump_factor /= 2;

    }while($prev_jf > 1);

    //done, we have inserted all the elements into the binary tree.
    //note that the array is currently empty so it is better to delete it
    unset($sortedArray);
    echo "Loop ran for : $step_counter times\n";
 }

 //for proving that the bin tree is balanced
 function printInOrder($parentNode){
    if($parentNode == null){
        return;
    }
    printInOrder($parentNode->left);
    echo "$parentNode->val -> ";
    printInOrder($parentNode->right);
}

 //Testing
 $sortedArray = range(1, 50);
 $bintree = new BinarySearchTree();
 //insert into bintree
 InsertIntoBinaryTree($bintree, $sortedArray);
 $bintree->printTree();

 //print tree in order
 echo "\nPrinting In Order \n";
 $rootNode = $bintree->getRoot();
 printInOrder($rootNode);
  





