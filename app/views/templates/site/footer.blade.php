
            <footer class="main-footer">
                <div class="copy">
                    ©
                    {{ trans('interface.footer.copyright') }}
                    2014{{ date('Y')>2014 ? '-'.date('Y') : '' }}
                </div>
                <address>
                    {{ trans('interface.footer.address') }}
                </address>
                <a class="htg-link" href="{{ URL::route('page', 'about#map') }}">
                    {{ trans('interface.footer.how_to_get') }}
                </a>
                <div class="dev">
                    {{ trans('interface.footer.made_by_grapheme') }}
                </div>
            </footer>
        </div>
