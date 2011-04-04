<?php
class Magneto_Debug_Block_Debug extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
    private function createDummyPanel($title){
        $panel = array(
            'title' => $title,
            'has_content' => true,
            'url' => NULL,
            'dom_id' => 'debug-panel-' . $title,
            'nav_title' => $title,
            'nav_subtitle' => 'Subtitle for ' . $title,
            'content' => 'Some content for ' . $title,
            'template' => 'debug_versions_panel'
        );
        return $panel;
    }
            
    protected function createVersionsPanel() {
        $title = 'Versions';
        $content = '';
         $panel = array(
            'title' => $title,
            'has_content' => true,
            'url' => NULL,
            'dom_id' => 'debug-panel-' . $title,
            'nav_title' => $title,
            // 'content' => 'Subtitle for ' . $title,
            'nav_subtitle' => 'Magento and modules version',
            'template' => 'debug_versions_panel',           // child block defined in layout xml
        );
        return $panel;
    }    
	
	protected function createPerformancePanel() {
        $title = 'Performance';
		$helper = Mage::helper('debug');
         $panel = array(
            'title' => $title,
            'has_content' => true,
            'url' => NULL,
            'dom_id' => 'debug-panel-' . $title,
            'nav_title' => $title,
            'nav_subtitle' => "TIME: {$helper->getScriptDuration()}s MEM: {$helper->getMemoryUsage()}",
            'template' => 'debug_performance_panel',
        );
        return $panel;
    } 

    protected function createConfigPanel() {
        $title = 'Configuration';
        $content = '';
        $panel = array(
            'title' => $title,
            'has_content' => true,
            'url' => NULL,
            'dom_id' => 'debug-panel-' . $title,
            'nav_title' => $title,
            'nav_subtitle' => 'Configuration',
            'template' => 'debug_config_panel',           // child block defined in layout xml
        );
        return $panel;
    }

	 
    protected function createBlocksPanel() {
        $title = 'Blocks';
		$nBlocks = count(Mage::getSingleton('debug/observer')->getBlocks());
		
        $panel = array(
            'title' => $title,
            'has_content' => true,
            'url' => NULL,
            'dom_id' => 'debug-panel-' . $title,
            'nav_title' => $title,
            'nav_subtitle' => "{$nBlocks}used blocks",
            'template' => 'debug_blocks_panel',           // child block defined in layout xml
        );
        return $panel;
    }
	
	
	protected function createLayoutPanel() {
        $title = 'Layout';
        $panel = array(
            'title' => $title,
            'has_content' => true,
            'url' => NULL,
            'dom_id' => 'debug-panel-' . $title,
            'nav_title' => $title,
            'nav_subtitle' => "Layout handlers",
            'template' => 'debug_layout_panel',           // child block defined in layout xml
        );
        return $panel;
    }
	
	protected function createControllerPanel() {
        $title = 'Controller';
        $content = '';
        $panel = array(
            'title' => $title,
            'has_content' => true,
            'url' => NULL,
            'dom_id' => 'debug-panel-' . $title,
            'nav_title' => $title,
            'nav_subtitle' => 'Controller and request',
            'template' => 'debug_controller_panel',           // child block defined in layout xml
        );
        return $panel;
    }   


    protected function createModelsPanel() {
        $title = 'Models';
		$nModels = count(Mage::getSingleton('debug/observer')->getModels());
		$nQueries = count(Mage::getSingleton('debug/observer')->getQueries());
        $panel = array(
            'title' => $title,
            'has_content' => true,
            'url' => NULL,
            'dom_id' => 'debug-panel-' . $title,
            'nav_title' => $title,
            'nav_subtitle' => "{$nModels} models, {$nQueries} queries",
            'template' => 'debug_models_panel',           // child block defined in layout xml
        );
        return $panel;
    } 
    
    public function getPanels() {
        $panels = array();
        $panels[] = $this->createVersionsPanel();
		$panels[] = $this->createPerformancePanel();
        $panels[] = $this->createConfigPanel();
		$panels[] = $this->createControllerPanel();
		$panels[] = $this->createModelsPanel();
		$panels[] = $this->createLayoutPanel();
        $panels[] = $this->createBlocksPanel();

        return $panels;
    }

    public function getDebugMediaUrl() {
        // FIXME: don't hardcode media url
        return '/media/debug/';
    }
}
