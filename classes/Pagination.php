<?php
class Pagination {
	private $_pages;
	private $_currentPage;
	private $_range;
	private $_start;
	private $_end;
	
	public function __construct($pages,$currentPage,$range) {
		$this->_pages = $pages;
		$this->_currentPage = $currentPage;
		$this->_range = $range;
		if($this->_currentPage - $this->_range > 0) $this->_start = $this->_currentPage - $this->_range;
		else $this->_start = 1;
		if($this->_currentPage + $this->_range > $this->_pages) $this->_end = $this->_pages;
		else $this->_end = $this->_currentPage + $this->_range;
	}
	
	public function getPaginationLinks($href = '') {
		$pagination = '';
		if($this->_currentPage > 1)
			$pagination .= '<a href="'.$href.'?p='.($this->_currentPage - 1).'" title="'.($this->_currentPage - 1).'">&laquo; Anterior</a>';
		for($i = $this->_start;$i<=$this->_end;$i++) {
		
			if($i != $this->_currentPage)
				$pagination .= '<a href="'.$href.'?p='.$i.'" title ="'.$i.'">'.$i.'</a>';
			else
				$pagination .= '<a class="current" href="'.$href.'?p='.$i.'">'.$i.'</a>';
		}
		if($this->_currentPage + 1 <= $this->_pages)
			$pagination .= '<a href="'.$href.'?p='.($this->_currentPage + 1).'" title="'.($this->_currentPage + 1).'">Siguiente &raquo;</a>';
		return $pagination;
	}
}