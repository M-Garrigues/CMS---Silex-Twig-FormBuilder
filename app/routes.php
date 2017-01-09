<?php

use Symfony\Component\HttpFoundation\Request;
use fc\Domain\Article;
use fc\Domain\Entry;
use fc\Domain\Tab;
use fc\Form\Type\ArticleType;
use fc\Form\Type\EntryType;
use fc\Form\Type\TabType;

//============== ACCUEIL ==============//
$app->get('/', function () use ($app) {

	$tabs = $app['dao.tab']->findAll();
	foreach ($tabs as $tab) {
		$tab->setEntries($app['dao.entry']->findAllByTab($tab->getId()));
	}

    $articles = $app['dao.article']->findAll();
    return $app['twig']->render('index.html.twig', array('articles' => $articles,
    													 'menu' => $tabs));
})->bind('home');	




//============== ONGLETS ==============//
$app->get('/onglet/{url}', function($url) use($app){
	$tabs = $app['dao.tab']->findAll();
	foreach ($tabs as $tab) {
		$tab->setEntries($app['dao.entry']->findAllByTab($tab->getId()));
	}

	$tab = $app['dao.tab']->findByUrl($url);
	foreach ($tab as $tab) {
		$tab->setEntries($app['dao.entry']->findAllByTab($tab->getId()));
	}
	$entries = array();
	$entries = $tab->getEntries();
    return $app['twig']->render('onglet.html.twig', array('tab' => $tab,
    													  'entries' => $entries,
    													  'menu' => $tabs));
})->bind('tab');



//============== ENTREES ==============//
$app->get('/entree/{url}', function($url) use($app){
	$tabs = $app['dao.tab']->findAll();
	foreach ($tabs as $tab) {
		$tab->setEntries($app['dao.entry']->findAllByTab($tab->getId()));
	}

	$entry = $app['dao.entry']->findByUrl($url);
	$articles = $app['dao.article']->findAllByEntry($entry->getId());
    return $app['twig']->render('entree.html.twig', array('articles' => $articles,
    													  'entry' => $entry,
    													  'menu' => $tabs));

})->bind('entry');





//============== ARTICLES ==============//
$app->get('/article/{id}', function($id) use($app){
	$tabs = $app['dao.tab']->findAll();
	foreach ($tabs as $tab) {
		$tab->setEntries($app['dao.entry']->findAllByTab($tab->getId()));
	}

	$article = $app['dao.article']->findById($id);
    return $app['twig']->render('article.html.twig', array('article' => $article,
    													   'menu' => $tabs));

})->bind('article');



//**************************************** ADMIN ********************************************



//============== ADMIN MAIN ==============//
$app->get('/admin', function() use($app){

	$tabs = $app['dao.tab']->findAll();
	foreach ($tabs as $tab) {
		$tab->setEntries($app['dao.entry']->findAllByTab($tab->getId()));
	}

    return $app['twig']->render('admin.html.twig', array('menu' => $tabs));

})->bind('admin');
















//============== ADMIN ENTRY ==============//



$app->get('/admin/entree/{url}', function($url) use($app){

	$tabs = $app['dao.tab']->findAll();
	foreach ($tabs as $tab) {
		$tab->setEntries($app['dao.entry']->findAllByTab($tab->getId()));
	}

	$entry = $app['dao.entry']->findByUrl($url);
	$articles = $app['dao.article']->findAllByEntry($entry->getId());

    $tabUrl = $app['dao.tab']->getById($entry->getTabId())->getUrl();


    return $app['twig']->render('admin-entry.html.twig', array( 'entry' => $entry,
    															'menu' => $tabs,
    															'articles' => $articles,
                                                                'url' => $tabUrl));

})->bind('admin_entry');




//ajouter une entrée
$app->match('/admin/{url}/ajouter/entree', function(Request $request, $url) use ($app) {
	$tabs = $app['dao.tab']->findAll();
	foreach ($tabs as $tab) {
		$tab->setEntries($app['dao.entry']->findAllByTab($tab->getId()));
	}


    $entry = new Entry();

    $entryForm = $app['form.factory']->create(new EntryType(), $entry);

    $entryForm->handleRequest($request);

    if ($entryForm->isSubmitted() && $entryForm->isValid()) {

    	$tabId = $app['dao.tab']->getByUrl($url);
        $entry->setTabId($tabId->getId());

        $app['dao.entry']->save($entry);

        $app['session']->getFlashBag()->add('success', "L'entrée a bien été ajoutée.");

        return $app->redirect($app['url_generator']->generate('admin_entry', array('url' => $entry->getUrl())));

    }

    return $app['twig']->render('entry_form.html.twig', array(

        'title' => 'Nouvelle entrée',

        'entryForm' => $entryForm->createView(),

        'menu' => $tabs

        ));

})->bind('admin_entry_add');


// Edit an existing entry

$app->match('/admin/{url}/editer/entree/{id}', function($url, $id, Request $request) use ($app) {
	$tabs = $app['dao.tab']->findAll();
	foreach ($tabs as $tab) {
		$tab->setEntries($app['dao.entry']->findAllByTab($tab->getId()));
	}


    $entry = $app['dao.entry']->findById($id);

    $tabId =$app['dao.tab']->getByUrl($url);
    $entry->setTabId($tabId->getId());

    $entryForm = $app['form.factory']->create(new EntryType(), $entry);

    $entryForm->handleRequest($request);

    if ($entryForm->isSubmitted() && $entryForm->isValid()) {

        $app['dao.entry']->save($entry);

        $app['session']->getFlashBag()->add('success', "L'entrée a bien été mise à jour.");

        return $app->redirect($app['url_generator']->generate('admin_entry', array('url' => $entry->geturl())));
    }

    return $app['twig']->render('entry_form.html.twig', array(

        'title' => 'Modification entrée',

        'entryForm' => $entryForm->createView(),

        'menu' => $tabs));

})->bind('admin_entry_edit');


// Remove an entry

$app->get('/admin/supprimer/entree/{id}', function($id, Request $request) use ($app) {

    // Delete the entry and the associated articles.
    $app['dao.entry']->delete($id);

    $app['session']->getFlashBag()->add('success', "L'entrée a bien été supprimée.");

    // Redirect to admin home page

    return $app->redirect($app['url_generator']->generate('admin'));

})->bind('admin_entry_delete');









//================== ADMIN TAB =====================================



$app->match('/admin/editer/{url}', function($url, Request $request) use ($app) {
	$tabs = $app['dao.tab']->findAll();
	foreach ($tabs as $tab) {
		$tab->setEntries($app['dao.entry']->findAllByTab($tab->getId()));
	}


    $tab = $app['dao.tab']->getByUrl($url);

    $tabForm = $app['form.factory']->create(new TabType(), $tab);

    $tabForm->handleRequest($request);

    if ($tabForm->isSubmitted() && $tabForm->isValid()) {

        $app['dao.tab']->save($tab);

        $app['session']->getFlashBag()->add('success', "L'onglet a bien été mis à jour.");

        return $app->redirect($app['url_generator']->generate('admin'));
    }

    return $app['twig']->render('tab_form.html.twig', array(

        'title' => 'Modification onglet',

        'tabForm' => $tabForm->createView(),

        'menu' => $tabs));

})->bind('admin_tab_edit');











// ======================== ADMIN ARTICLES =========================================

//ajouter une article
$app->match('/admin/{url}/ajouter/article', function(Request $request, $url) use ($app) {
	$tabs = $app['dao.tab']->findAll();
	foreach ($tabs as $tab) {
		$tab->setEntries($app['dao.entry']->findAllByTab($tab->getId()));
	}


    $article = new Article();

    $articleForm = $app['form.factory']->create(new ArticleType(), $article);

    $articleForm->handleRequest($request);

    if ($articleForm->isSubmitted() && $articleForm->isValid()) {

    	$entryId = $app['dao.entry']->getByUrl($url);
        $article->setEntryId($entryId->getId());

        $app['dao.article']->save($article);

        $app['session']->getFlashBag()->add('success', "L'article a bien été ajouté.");

        return $app->redirect($app['url_generator']->generate('admin_entry',array("url" => $url)));

    }

    return $app['twig']->render('article_form.html.twig', array(

        'title' => 'Nouvel article',

        'articleForm' => $articleForm->createView(),

        'menu' => $tabs));

})->bind('admin_article_add');


// Edit an existing article

$app->match('/admin/{url}/editer/article/{id}', function($url, $id, Request $request) use ($app) {
	$tabs = $app['dao.tab']->findAll();
	foreach ($tabs as $tab) {
		$tab->setEntries($app['dao.entry']->findAllByTab($tab->getId()));
	}


    $article = $app['dao.article']->findById($id);

    $articleForm = $app['form.factory']->create(new ArticleType(), $article);

    $articleForm->handleRequest($request);

    if ($articleForm->isSubmitted() && $articleForm->isValid()) {

        $app['dao.article']->save($article);

        $app['session']->getFlashBag()->add('success', "L'article a bien été mis à jour.");

        return $app->redirect($app['url_generator']->generate('article',array("id" => $id)));
    }

    return $app['twig']->render('article_form.html.twig', array(

        'title' => 'Modification article',

        'articleForm' => $articleForm->createView(),

        'menu' => $tabs));

})->bind('admin_article_edit');


// Remove an article

$app->get('/admin/supprimer/article/{id}', function($id, Request $request) use ($app) {

    // Delete the article and the associated articles.
    $app['dao.article']->delete($id);

    $app['session']->getFlashBag()->add('success', "L'article a bien été supprimé.");

    // Redirect to admin home page

    return $app->redirect($app['url_generator']->generate('admin'));

})->bind('admin_article_delete');