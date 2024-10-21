<?php

Breadcrumbs::for('dashboard.media-registers.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(trans('Media Registers'), route('dashboard.media-registers.index'));
});

Breadcrumbs::for('dashboard.media-registers.show', function ($breadcrumb, $subscriber) {
    $breadcrumb->parent('dashboard.media-registers.index');
    $breadcrumb->push($subscriber->name, route('dashboard.media-registers.show', $subscriber));
});
