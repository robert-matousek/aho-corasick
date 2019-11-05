<?php
/**
 * aho-corasick algorithm that locates elements of a finite set of strings
 * within an input text 
 */
  class Trie
  {
    public $root; // root node
    
    /**
     * constructs a finite state pattern matching machine that locates keywords
     * in a text string
     * @param array $keywords array with top level domains
     */
    function __construct($keywords)
    {
      $this->root = new Node(true, false); // root node
      $this->root->set_failurenode(false);
    
      for ($i=0; $i<count($keywords); $i++) // construct tree
      {
        $this->enter($keywords[$i]);
      }
      
      $this->fail(); // set backnodes 
    }         
    
    /**
     * @method void add a keyword to the finite state pattern matching machine
     * @param string $string the keyword to be added to the finite state 
     * pattern matching machine
     * @param int number representing a state
     */
    function enter($string)
    {
      $chars = str_split($string); // convert string into an array of characters
      $i = 0;
      $node = $this->root;
      while ($node->get_child($chars[$i]) != false) // traverse tree
      {
        $node = $node->get_child($chars[$i]);
				$i++;
      }
      
      for ($j=$i; $j<count($chars); $j++) // build tree
      { 
				if ($j == count($chars)-1) {
				 	$child = new Node(false, true, $chars[$j], $node);
				} else {
					$child = new Node(false, false, $chars[$j], $node); // internal node
				}
				$node->add_child($chars[$j], $child);
        $node = $child;
      }
    }
    
    /**
     * @method void computes the failure function for each node in the finite
     * state pattern matching machine
     */   
   function fail() {
      			
			// for all nodes of depth 1      
      $queue = $this->root->get_children();
			foreach ($queue as $node)
			{
				$node->set_failurenode($this->root);
			}
      
      // for all other nodes
      while (!empty($queue))
      {
				$node = array_shift($queue); // dequeue
								
				if (!$node->is_leaf())
				{	 
				 	$children = $node->get_children();		
					foreach ($children as $symbol => $child)
					{
						$queue[] = $child;
												
						$fnode = $node->get_failurenode();						
						while ($fnode->get_child($symbol) == false && !$fnode->is_root())
						{
							$fnode = $fnode->get_failurenode();
						}

						if ($fnode->get_child($symbol)) {
							$child->set_failurenode($fnode->get_child($symbol));
						} else {
							$child->set_failurenode($this->root);
						}
					}
				}
			}	
		}

    /**
     * @method mixed searches for keywords within a text string
     * @param string $string the text string to be searched
     * @return array array with starting and ending indexes of keywords within the 
     * input string
     */
    function match($string) {
      
      $output = array(); // start, end positions
      $chars = str_split($string); // convert string into an array of characters    
      $node = $this->root;
      
      for ($i=0; $i<count($chars); $i++)
      {
        while ($node->get_child($chars[$i]) == false)
        {          
					if ($node->is_root()) {
						$i++; // next character
					} else {
						$node = $node->get_failurenode();

						if ($node->is_endnode()) {
						 echo($node->get_string);
							$output[] = array($i-($this->get_depth($node)), $i-1);
						}
					}	
        }
        $node = $node->get_child($chars[$i]);
        
        if ($node->is_endnode()) {
          $output[] = array($i+1-($this->get_depth($node)), $i);
        }
      
			}
			return $output;         
    }
    /**
     * @method string removes any dots from the text string
     * @return string the text string to be searched
     */
  	function filter($string)
  	{
			$string = str_replace('.', '', $string);
			return $string;		
	}

    
    /**
     * @method returns the depth of this node
     * @param object node
     */
    function get_depth($node)
    {
      $depth = 0; // node depth
      while($node->is_root() == false) // traverse up the tree
      {
        $node = $node->get_parent();
        $depth++;
      }
      return $depth;  
    }
               
  }
