@php
// Blog leaderboard block — Modules/Blog/docs/wiki.
@endphp

@props([
    'tpl',
    'version' => 'v1',
    'title' => $block['data']['title']
])

<!-- Leader Board Starts -->
<div class="row gape">
    <div class="col-xl-12">
        <div class="userpart wow fadeInUp">
            <div class="userpart__title d-flex gap-1 gap-md-2 align-items-center mb20">
                <i class="material-symbols-outlined">
                    monitoring
                    </i>
                <h4>Classifiche</h4>
            </div>
            <ul class="nav nav-tabs userpart__dayweek" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active f18" data-bs-toggle="tab" href="#top_user">Top Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link f18" data-bs-toggle="tab" href="#menu1">Articoli con più scommesse</a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content" 
                    style="display:block;"
                    >
                <div id="top_user" class="container tab-pane active"><br>
                    @include('blog::components.blocks.leaderboard.bootstrap_version.top_users')
                </div>
                <div id="menu1" class="container tab-pane fade"><br>
                    @include('blog::components.blocks.leaderboard.bootstrap_version.top_bet_articles')
                </div>
                <div id="menu2" class="container tab-pane fade"><br>
                </div>
                <div id="menu3" class="container tab-pane fade"><br>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Leader Board Ends -->
