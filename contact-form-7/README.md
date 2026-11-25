# Contact Form 7

Source for the site's CF7 forms and their emails. Nothing here is loaded by
the theme: the contents are pasted into the CF7 admin (Contact → form).

```
forms/                       Form markup ("Form" tab)
  kontakt.html                 Kontakt page
  uber-uns.html                Über uns page
  werkstatt.html
  ankauf.html
emails/
  src/                         MJML sources: edit these
    partials/                    shared by every email (font, logo)
    de/                          one folder per language
      <form>/notification.mjml     "Mail" tab: sent to Auto Fischer
      <form>/confirmation.mjml     "Mail (2)" tab: sent to the visitor
  html/                        compiled output: paste into CF7, don't edit
  build.mjs
```

## Emails

```
npm run mail          # compile src/ -> html/
npm run mail:watch    # recompile on every save
```

Paste the compiled HTML into the matching tab's *Message body* with
*Use HTML content type* checked. `[your-…]` placeholders are CF7 mail tags
and must match the field names in `forms/`.

Preview while editing: VS Code extension **MJML** (`attilabuti.vscode-mjml`)
→ *MJML: Open Preview to the Side*.

### Adding a language

Copy `emails/src/de/` to e.g. `emails/src/fr/`, translate the texts, set
`<mjml lang="fr">` and run `npm run mail`. Partials are shared, so the logo
and font stay in one place.
