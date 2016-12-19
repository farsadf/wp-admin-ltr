<?php

/**
 * By: farsad
 * Date: 12/2/2016
 * Time: 2:38 PM
 */
class admin_ltr_panel
{
    #region Class Members
    private $page_id = 'admin-panel';

    private $page_address_base = null;
    private $page_address = null;

    private $page_title = null;
    private $page_tabs = array();

    private $default_tab = null;
    #endregion

    #region Getters & Setters
    /**
     * @return string
     */
    public function getPageId()
    {
        return $this->page_id;
    }

    /**
     * @param string $page_id
     */
    public function setPageId($page_id)
    {
        $this->page_id = $page_id;
    }

    /**
     * @return null
     */
    public function getPageAddressBase()
    {
        return $this->page_address_base;
    }

    /**
     * @param null $page_address_base
     */
    public function setPageAddressBase($page_address_base)
    {
        $this->page_address_base = $page_address_base;
    }

    /**
     * @return null
     */
    public function getPageAddress()
    {
        return $this->page_address;
    }

    /**
     * @param null $page_address
     */
    public function setPageAddress($page_address)
    {
        $this->page_address = $page_address;
    }

    /**
     * @return null
     */
    public function getPageTitle()
    {
        return $this->page_title;
    }

    /**
     * @param null $page_title
     */
    public function setPageTitle($page_title)
    {
        $this->page_title = $page_title;
    }

    /**
     * @return array
     */
    public function getPageTabs()
    {
        return $this->page_tabs;
    }

    /**
     * @param array $page_tabs
     */
    public function setPageTabs($page_tabs)
    {
        if( is_array($page_tabs) ) {
            foreach ($page_tabs as $tab) {
                if( is_array($tab) ) {
                    if( ! empty ( $tab['title'] )
                        && ! empty ( $tab['id'] )
                        && ( ! empty ( $tab['callback'] ) && function_exists( $tab['callback'] ) || !empty ( $tab['content'] ) ) ) {
                        $tabID = 'tab_' . $tab['id'];
                        unset($tab['id']);

                        if(isset($tab['default']))
                            $this->default_tab = $tabID;

                        $this->page_tabs[$tabID] = $tab;
                    } else
                        continue;
                } else
                    continue;
            }
            if($this->default_tab == null)
                $this->default_tab = array_shift(array_keys($this->page_tabs));
        }
    }

    /**
     * @return null
     */
    public function getDefaultTab()
    {
        return $this->default_tab;
    }

    /**
     * @param null $default_tab
     */
    public function setDefaultTab($default_tab)
    {
        $this->default_tab = $default_tab;
    }
    #endregion

    #region Panel Engine
    /**
     * @param $tabID
     * @return mixed
     */
    private function getContentForTab($tabID) {
        if(isset($this->page_tabs[$tabID]['callback']))
            return call_user_func($this->page_tabs[$tabID]['callback']);
        else
            return $this->page_tabs[$tabID]['content'];
    }

    /**
     * @return string generated page content
     */
    public function generatePage() {
        $return = '<div id="' . $this->page_id . '" class="wrap">
            <h2 class="page-title">' . $this->page_title . '</h2>
            <h2 class="nav-tab-wrapper">';
        foreach($this->page_tabs as $tabID => $tab) {
            $current = (!empty($_GET['tab']) && $tabID == $_GET['tab'] || (!isset($_GET['tab']) && $tabID == $this->default_tab)) ? ' nav-tab-active' : '';
            $return .= '<a class="nav-tab' . $current . '" href="' . admin_url() . $this->page_address_base . '?page=' . $this->page_address . '&tab=' . $tabID . '">' . $tab['title'] . '</a>';
        }
        $return .= '</h2>
            <div class="page-content">';
        $return .= $this->getContentForTab(!empty($_GET['tab']) ? $_GET['tab'] : $this->default_tab);
        $return .= '</div></div>';

        return $return;
    }
    #endregion
}