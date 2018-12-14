<?php
namespace app\components;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\base\Widget;
use yii\data\Pagination;

class MyPager extends \yii\widgets\LinkPager
{

    protected function renderPageButton($label, $page, $class, $disabled, $active)
    {
        $options = ['class' => $class === '' ? null : $class];
        if ($active) {
            Html::addCssClass($options, $this->activePageCssClass);
        }
        if ($disabled) {
            Html::addCssClass($options, $this->disabledPageCssClass);

            return  Html::tag('span', $label);
        }
        $linkOptions = $this->linkOptions;
        $linkOptions['data-page'] = $page;
        $linkOptions['class'] = 'page-link waves-effect waves-effect';

        return '<li class="page-item">'.Html::a($label, $this->pagination->createUrl($page), $linkOptions).'</li>';
    }


    protected function renderPageButtons()
    {
        $pageCount = $this->pagination->getPageCount();
        if ($pageCount < 2 && $this->hideOnSinglePage) {
            return '';
        }

        $buttons = [];
        $currentPage = $this->pagination->getPage();

        // first page
        $firstPageLabel = $this->firstPageLabel === true ? '1' : $this->firstPageLabel;
        if ($firstPageLabel !== false) {
            $buttons[] = $this->renderPageButton($firstPageLabel, 0, $this->firstPageCssClass, $currentPage <= 0, false);
        }

        // prev page
        if ($this->prevPageLabel !== false) {
            if (($page = $currentPage - 1) < 0) {
                $page = 0;
            }
            $buttons[] = $this->renderPageButton($this->prevPageLabel, $page, $this->prevPageCssClass, $currentPage <= 0, false);
        }

        // internal pages
        list($beginPage, $endPage) = $this->getPageRange();
        for ($i = $beginPage; $i <= $endPage; ++$i) {
            $buttons[] = $this->renderPageButton($i + 1, $i, null, false, $i == $currentPage);
        }

        // next page
        if ($this->nextPageLabel !== false) {
            if (($page = $currentPage + 1) >= $pageCount - 1) {
                $page = $pageCount - 1;
            }
            $buttons[] = $this->renderPageButton($this->nextPageLabel, $page, $this->nextPageCssClass, $currentPage >= $pageCount - 1, false);
        }

        // last page
        $lastPageLabel = $this->lastPageLabel === true ? $pageCount : $this->lastPageLabel;
        if ($lastPageLabel !== false) {
            $buttons[] = $this->renderPageButton($lastPageLabel, $pageCount - 1, $this->lastPageCssClass, $currentPage >= $pageCount - 1, false);
        }

        return Html::tag('ul', implode("\n", $buttons), $this->options);
    }
}

/*
<div class="pagination"><span>←</span>
    <a href="/blog?page=1" data-page="0">1</a>
    <a href="/blog?page=2" data-page="1">2</a>
    <a href="/blog?page=2" data-page="1">→</a>
</div>
*/

/*
<!--Pagination-->
<nav class="row flex-center wow fadeIn" data-wow-delay="0.2s" style="animation-name: none; visibility: visible;">
    <ul class="pagination">
        <li class="page-item disabled">
            <a class="page-link waves-effect waves-effect" href="#!" aria-label="Previous">
                <span aria-hidden="true">«</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        <li class="page-item active">
            <a class="page-link waves-effect waves-effect" href="#!">
                1 <span class="sr-only">(current)</span>
            </a>
        </li>
        <li class="page-item">
            <a class="page-link waves-effect waves-effect" href="#!">2</a>
        </li>
        <li class="page-item">
            <a class="page-link waves-effect waves-effect" href="#!">3</a>
        </li>
        <li class="page-item">
            <a class="page-link waves-effect waves-effect" href="#!">4</a>
        </li>
        <li class="page-item">
            <a class="page-link waves-effect waves-effect" href="#!">5</a>
        </li>
        <li class="page-item">
            <a class="page-link waves-effect waves-effect" href="#!" aria-label="Next">
                <span aria-hidden="true">»</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    </ul>
 </nav>
<!--/.Pagination-->
*/