<?php
class Fonfonblog_Controller_Navigation 
{
	
	public function getMenuHeader () 
	{
		$tab = array(
				array(
					'label' => 'Compétences',
					'class' => 'active',
					'controller' => 'competences',
					'action' => 'index',
					'resource' => 'competences',
					'privilege' => 'index'
				),
				array(
					'label' => 'Experiences',
					'controller' => 'emplois',
					'action' => 'index',
					'resource' => 'emplois',
					'privilege' => 'index'
				),
				array(
					'label' => 'Contact',
					'action' => 'index',
					'controller' => 'contact',
					'resource' => 'contact',
					'privilege' => 'index'
				)

		);
		
		// On verifie que l utilisateur est authentifié
		if (Zend_Auth::getInstance()->hasIdentity()) {
			return array_merge($tab, $this->_menuAccessAdministration(), $this->_menuUser());
		} else {
			return array_merge($tab, $this->_menuNoUser());
		}
	}

	/**
	 * Menu si user connecté
	 * @return multitype:
	 */
	private function _menuUser () {
		return array(
			array(
				'label' => 'Mon profil',
				'controller' => 'utilisateurs',
				'action' => 'view',
				'params' => array('id' => Zend_Auth::getInstance()->getStorage()->read()->id_utilisateur),
				'resource' => 'utilisateurs',
				'privilege' => 'view'
			),
			array(
				'label' => 'Deconnexion',
				'controller' => 'auth',
				'action' => 'logout',
				'resource' => 'auth',
				'privilege' => 'logout'
			)
		);
	}
	
	private function _menuNoUser ()
	{
		return array(
				array(
					'label' => 'Connexion',
					'controller' => 'auth',
					'action' => 'login'
				)
		);
	}

	
	private function _menuAccessAdministration ()
	{
		return array( 
			array(
				'label' => 'Administration',
				'resource' => 'administration',
				'privilege' => 'index',
				'uri' => '#',
				'pages' => array(
					array(
		                'label' => 'Gestion compétences',
						'controller' => 'competences',
		                'action' => 'list',
		                'module' => 'admin',		
					),
					array(
		                'label' => 'Gestion compétences principales',
						'controller' => 'index',
		                'action' => 'index',
		                'module' => 'admin',		
					),
					array(
		                'label' => 'Gestion expériences',
						'controller' => 'experiences',
		                'action' => 'list',
		                'module' => 'admin',		
					)/*,
					array(
		                'label' => 'Gestion env. technique',
						'controller' => 'index',
		                'action' => 'index',
		                'module' => 'admin',		
					)*/
				)
			)
		);			
	}
	
	/**
	 * Generation des liens pour le footer
	 * @return multitype:multitype:string
	 */
	public function getLinksFooter ()
	{
		$tabFooter = array(
			array(
				'label' => 'facebook',
				'uri' => 'www.facebook.com/'
			),
			array(
				'label' => 'C.G.U.',
				'uri' => '/'
			),
			array(
				'label' => 'Mentions légales',
				'uri' => '/'
			),
		);
		return $tabFooter;
	}
}