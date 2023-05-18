<table class="action" align="center" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center">
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>
                                    <a href="{{ $url }}" class="button btn-theme" target="_blank">{{ $slot }}</a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<style type="text/css">
    .btn-theme{
            font-family: Avenir, Helvetica, sans-serif;
            box-sizing: border-box;
            border-radius: 3px;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16);
            color: #FFF;
            display: inline-block;
            text-decoration: none;
            -webkit-text-size-adjust: none;
            border-top: 10px solid #51CDCB;
            border-right: 18px solid #51CDCB;
            border-bottom: 10px solid #51CDCB;
            border-left: 18px solid #51CDCB;
            background-color: #51CDCB;
    }
</style>
