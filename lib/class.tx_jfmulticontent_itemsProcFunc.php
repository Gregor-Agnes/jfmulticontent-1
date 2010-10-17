<?php/*************************************************************** *  Copyright notice * *  (c) 2009 Juergen Furrer <juergen.furrer@gmail.com> *  All rights reserved * *  This script is part of the TYPO3 project. The TYPO3 project is *  free software; you can redistribute it and/or modify *  it under the terms of the GNU General Public License as published by *  the Free Software Foundation; either version 2 of the License, or *  (at your option) any later version. * *  The GNU General Public License can be found at *  http://www.gnu.org/copyleft/gpl.html. * *  This script is distributed in the hope that it will be useful, *  but WITHOUT ANY WARRANTY; without even the implied warranty of *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the *  GNU General Public License for more details. * *  This copyright notice MUST APPEAR in all copies of the script! ***************************************************************/require_once (PATH_t3lib . 'class.t3lib_page.php');/** * 'itemsProcFunc' for the 'jfmulticontent' extension. * * @author     Juergen Furrer <juergen.furrer@gmail.com> * @package    TYPO3 * @subpackage tx_jfmulticontent */class tx_jfmulticontent_itemsProcFunc{	/**	 * Get the defined styles by pagesetup	 * @param array $config	 * @param array $item	 */	function getStyle($config, $item)	{		$allStyles = array(			array(				$GLOBALS['LANG']->sL('LLL:EXT:jfmulticontent/locallang_db.xml:tt_content.tx_jfmulticontent.style.I.0'),				'2column',				'EXT:jfmulticontent/selicon_tt_content_tx_jfmulticontent_style_0.gif',			),			array(				$GLOBALS['LANG']->sL('LLL:EXT:jfmulticontent/locallang_db.xml:tt_content.tx_jfmulticontent.style.I.1'),				'3column',				'EXT:jfmulticontent/selicon_tt_content_tx_jfmulticontent_style_1.gif',			),			array(				$GLOBALS['LANG']->sL('LLL:EXT:jfmulticontent/locallang_db.xml:tt_content.tx_jfmulticontent.style.I.2'),				'4column',				'EXT:jfmulticontent/selicon_tt_content_tx_jfmulticontent_style_2.gif',			),			array(				$GLOBALS['LANG']->sL('LLL:EXT:jfmulticontent/locallang_db.xml:tt_content.tx_jfmulticontent.style.I.6'),				'5column',				'EXT:jfmulticontent/selicon_tt_content_tx_jfmulticontent_style_6.gif',			),			array(				$GLOBALS['LANG']->sL('LLL:EXT:jfmulticontent/locallang_db.xml:tt_content.tx_jfmulticontent.style.I.3'),				'tab',				'EXT:jfmulticontent/selicon_tt_content_tx_jfmulticontent_style_3.gif',			),			array(				$GLOBALS['LANG']->sL('LLL:EXT:jfmulticontent/locallang_db.xml:tt_content.tx_jfmulticontent.style.I.4'),				'accordion',				'EXT:jfmulticontent/selicon_tt_content_tx_jfmulticontent_style_4.gif',			),			array(				$GLOBALS['LANG']->sL('LLL:EXT:jfmulticontent/locallang_db.xml:tt_content.tx_jfmulticontent.style.I.5'),				'slider',				'EXT:jfmulticontent/selicon_tt_content_tx_jfmulticontent_style_5.gif',			),			array(				$GLOBALS['LANG']->sL('LLL:EXT:jfmulticontent/locallang_db.xml:tt_content.tx_jfmulticontent.style.I.7'),				'slidedeck',				'EXT:jfmulticontent/selicon_tt_content_tx_jfmulticontent_style_7.gif',			),			array(				$GLOBALS['LANG']->sL('LLL:EXT:jfmulticontent/locallang_db.xml:tt_content.tx_jfmulticontent.style.I.8'),				'easyaccordion',				'EXT:jfmulticontent/selicon_tt_content_tx_jfmulticontent_style_8.gif',			),		);		$pageTS = t3lib_BEfunc::getPagesTSconfig($config['row']['pid']);		$jfmulticontentStyles = t3lib_div::trimExplode(",", $pageTS['mod.']['jfmulticontent.']['availableStyles'], true);		$optionList = array();		if (count($jfmulticontentStyles) > 0) {			foreach ($allStyles as $key => $style) {				if (in_array(trim($style[1]), $jfmulticontentStyles)) {					$optionList[] = $style;				}			}		} else {			$optionList = $allStyles;		}		$config['items'] = array_merge($config['items'], $optionList);		return $config;	}/**/	/**	 * Get defined Class inner for dropdown	 * @return array	 */	function getClassInner($config, $item)	{		$confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['jfmulticontent']);		$availableClasses = t3lib_div::trimExplode(",", $confArr['classInner']);		if (count($availableClasses) < 1) {			$availableClasses = array('','16','20','25','33','38','40','50','60','62','66','75','80');		}		$pageTS = t3lib_BEfunc::getPagesTSconfig($config['row']['pid']);		$jfmulticontentClasses = t3lib_div::trimExplode(",", $pageTS['mod.']['jfmulticontent.']['classInner'], true);		$optionList = array();		if (count($jfmulticontentClasses) > 0) {			foreach ($availableClasses as $key => $availableClass) {				if (in_array(trim($availableClass), $jfmulticontentClasses)) {					$optionList[] = array(						trim($availableClass),						trim($availableClass),					);				}			}		} else {			$optionList = $availableClasses;		}		$config['items'] = array_merge($config['items'], $optionList);		return $config;	}	/**	 * Get all themes for anythingSlider	 * @return array	 */	function getAnythingSliderThemes($config, $item)	{		$confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['jfmulticontent']);		if (! is_dir(t3lib_div::getFileAbsFileName($confArr['anythingSliderThemeFolder']))) {			// if the defined folder does not exist, define the default folder			$confArr['anythingSliderThemeFolder'] = "EXT:jfmulticontent/res/anythingslider/themes/";		}		$items = t3lib_div::get_dirs(t3lib_div::getFileAbsFileName($confArr['anythingSliderThemeFolder']));		if (count($items) > 0) {			$optionList = array();			foreach ($items as $key => $item) {				$item = trim($item);				if (! preg_match('/^\./', $item)) {					$optionList[] = array(						$item,						$item					);				}			}			$config['items'] = array_merge($config['items'], $optionList);		}		return $config;	}	/**	 * Get all skins for easyAccordion	 * @return array	 */	function getEasyaccordionSkin($config, $item)	{		$confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['jfmulticontent']);		if (! is_dir(t3lib_div::getFileAbsFileName($confArr['easyAccordionSkinFolder']))) {			// if the defined folder does not exist, define the default folder			$confArr['easyAccordionSkinFolder'] = "EXT:jfmulticontent/res/easyaccordion/skins/";		}		$items = t3lib_div::get_dirs(t3lib_div::getFileAbsFileName($confArr['easyAccordionSkinFolder']));		if (count($items) > 0) {			$optionList = array();			foreach ($items as $key => $item) {				$item = trim($item);				if (! preg_match('/^\./', $item)) {					$optionList[] = array(						ucfirst($item),						$item					);				}			}			$config['items'] = array_merge($config['items'], $optionList);		}		return $config;	}}if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/jfmulticontent/lib/class.tx_jfmulticontent_itemsProcFunc.php']) {	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/jfmulticontent/lib/class.tx_jfmulticontent_itemsProcFunc.php']);}?>