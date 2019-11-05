<?php
  /**
   * a state in the finite state pattern matching machine
   */
  class Node
  {
      
    public $isroot; // root node, boolean
    public $isendnode; // keyword, boolean
    public $parent; // parent node, object    
    public $children; // children nodes, object
    public $backnode; // failure node, object    
    public $char; // character, char
    
    /**
     * @method void constructs a new node
     * @param boolean $root true if this is the root node, false otherwise
     * @param int $num keyword identier
     * @param string $keyword string belonging to node
     */      
    function __construct($root, $endnode, $char=null, $parent=null)
    {
      $this->isroot = $root;
      $this->isendnode = $endnode;
      $this->char = $char;
      $this->parent = $parent;      
      $this->children = array();
    }
      
      
    /**
     * @method void add a child node to a node
     * @param char $symbol character corresponding with the state transition
     * from the parent node to the child node
     * @param mixed $node the child node to be added 
     */ 
    function add_child($symbol, $node)
    {
      $this->children[$symbol] = $node;
    }
      
    /**
     * @method mixed returns the child node corresponding with the state 
     * transition for a character
     * @param $symbol state transition made by character
     */
    function get_child($symbol)
    {
      if(array_key_exists($symbol, $this->children)) {
        return $this->children[$symbol];
      } else {
        return false;
      } 
    }
      
    /**
     * @method array returns the children nodes
     */
    function get_children()
    {
      return $this->children;
    }
      
    /**
     * @method object maps a state into a state whenever the goto function fails
     */
    function get_failurenode()
    {
      return $this->backnode;
    }
      
    /**
     * @method void set the failure node for a node
     * @param object $node the node to map to
     */
    function set_failurenode($node)
    {
      $this->backnode = $node;   
    }
      
    /**
     * @method boolean returns true if this node is a leaf, false otherwise
     */
    function is_leaf()
    {
      return empty($this->children);
    }
    		
    /**
     * @method boolean returns true if this node is an end state, and thus
     * spells out a keyword by following the path from the root to this node
     */	
		function is_endnode()
		{
      return $this->isendnode;
		}
    /**
     * @method boolean returns true if this node is the root node, false
     * otherwise
     */
    function is_root()
    {
			return $this->isroot;
		}
		
		/**
     * @method object return parent node
     */ 
    function get_parent()
    {
      if ($this->isroot != true) {
        return $this->parent;          
      } else {
        return false;
      }
    }
    
		/**
     * @method char returns character
     */   
    function get_char()
    {
      if ($this->isroot != true) {
        return $this->char;
      } else {
        return false;
      }
    }
    
    /**
     * @ method boolean make endnode
     */
    function set_endnode($endnode)
    {
      $this->is_endnode = $endnode;
    }    
    		
  }
  
  ?>
