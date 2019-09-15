<?php
/**
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($value) { $this->val = $value; }
 * }
 */
class Solution {

    /**
     * @param TreeNode $root
     * @return Integer[]
     */
    function preorderTraversal($root) {
        $traversal = [];
        
        $stack = [ [ $root, false, false ] ];
        
        while ($stack) {
            $node = $stack[0][0];
            
            if (is_null($node)) {
                // The node is null, ascending
                array_shift($stack);
                continue;
            }
            
            $lvisited = $stack[0][1];
            $rvisited = $stack[0][2];
            
            if (!is_null($node->val) && !($lvisited || $rvisited)) {
                // 1st time visited: traversing value
                array_push($traversal, $node->val);
            }
            
            if (!$lvisited) {
                // Left node now visited, mark so
                $stack[0][1] = true;

                if (!is_null($node->left)) {
                    // Descending into the left node
                    array_unshift($stack, [ $node->left, false, false ]);
                } else {
                    // Going to descent into the right node on the next iteration
                    continue;
                }
            } else if (!$rvisited) {
                // Right node now visited, mark so
                $stack[0][2] = true;
                
                if (!is_null($node->right)) {
                    // Descending into the right node
                    array_unshift($stack, [ $node->right, false, false ]);
                } else {
                    // Ascending
                    array_shift($stack);
                    continue;
                }
            } else {
                // Both visited, ascending
                array_shift($stack);
            }
        }
        
        return $traversal;
    }
}
