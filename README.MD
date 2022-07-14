
Un petit peu de lecture pour une meilleur prise en main de la suite du projet.

!! IMPORTANTS !!
<ul>
    <li>Ne pas changer les id des address et des bars en BDD !</li>
</ul>


1.Prise en main

ESCAPE = ROOM 

Blabla

----
3.Info importantes

Une variable 'metadata' en envoyé a la vue principale pour switcher entre les différents infos du front.

Exemple: Couleur du bandeau / différent logo...
Les 'metadata' possibles sont ['malleus', 'episode0'] 

Si une 'metadata' n'est pas defini, il s'agit du rendu standard.

----
4.Traduction

Pour la traduction ecrire {%trans%}MonMot{%endtrans%} dans le HTML puis rentré la commande:
 
 => php bin/console translation:extract en --force 
 Chercher dans les fichiers trnaslations\messages+intl.... Les traductions y sont.

----
5.Conseils

 