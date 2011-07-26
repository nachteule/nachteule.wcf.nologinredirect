<?php
require_once(WCF_DIR.'lib/system/event/EventListener.class.php');

/**
 * Removes redirect from login.
 *
 * @author	Nachteule`
 * @license	GNU Lesser General Public License
 * @package nachteule.wcf.nologinredirect
 * @subpackage system.event.listener
 */
class NoLoginRedirectListener implements EventListener {
	/**
	 * @see EventListener::execute()
	 */
	public function execute($eventObj, $className, $eventName) {
		switch ($className) {
			case 'IndexPage':
				if (WCF::getSession()->getVar('loginSuccess')) {
					WCF::getTPL()->append('userMessages', '<p class="success">'.WCF::getLanguage()->get('wcf.user.login.redirect').'</p>');
					WCF::getSession()->unregister('loginSuccess');
				}
				break;
			case 'UserLoginForm':
				WCF::getSession()->register('loginSuccess', true);
				HeaderUtil::redirect('index.php?page=Index'.SID_ARG_2ND_NOT_ENCODED);
				exit;
		}
	}
}
