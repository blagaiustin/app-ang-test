Adauga fisierul cu baza de date din directorul sql. Acest director nu are legatura cu restul de fisiere si directoare.
Asadar, acesta contine doar baza de date ce trebuie adaugata in phpmyadmin pentru ca aplicatia sa foloseasca aceasta baza de date.
Toate informatiile de conectare la conturi sunt in baza de date.

Notificari:
Partea de CRUD nu a fost construita de la 0 ci adaptata si refolosita pentru a creea acest proiect.

Cum a fost construita aplicatia?
Comentariile din proiect sunt foarte intuitive si explica foarte bine modul in care aplicatia a fost gandita

Cum se foloseste?
Se intra pe http://localhost/app-ang-test/ unde se gasete un formular de logare. Conturile sunt create de mine in baza de date si se gasesc in tabela accounts. Exista doar doua conturi, ele reprezentand conturile de admin(user: admin, parola: 12345; user: maria, parola: 54321). Parolele nu au mai fost criptate in baza de date. Stiu ca este o practica buna si un lucru necesar dar nu am mai reusit sa realizez si acest aspect. La partea de "mi-am uitat parola" am realizat doar partea de front-end. Nu era in cerinte asa ca nu am implementat-o. 
O data ce logarea a reusit se creeaza o pagina a acelui cont. Ea va contine mesajul de "Bun venit numeUtilizator" un buton de logout(acesta o data apasat sterge pagina creata in accounts a user-ului) si un formular de conectare la baza de date. Imediat ce apasam pe conectare ne vor aparea 3 optiuni. Prima este de a ne reintoarce inapoi, a doua de a creea o tabela si ultima de a selecta o tabela. O data intrati intr-o anumita tabela se pot vizualiza, se pot adauga si edita elemente din aceasta. Am observat ca in anumite cazuri afisazul nu functioneaza corect. Mai exista in dreapta sus un buton "SQL" de unde se pot da interogari. Daca admin-ul adauga ceva nou se poate observa in phpmyadmin ca baza de date se modifica dupa refresh. Totusi pentru a vede schimbarile si in aplicatia nostra CRUD trebuie sa ne ducem in spate pana la primul pas apasand pe butoanele din stanga sus a ecranului. O data ajunsi acolo trebuie sa ne conectam din nou la acea baza de date. Cand intram iar in tabelul nostru vom vedea si elementele intorduse ultima data.
Daca contul ce se loga era unul de user normal si nu de administrator ar fi trebuit sa il conduca la un altfel de pagina de unde acesta sa poata da anumite comenzi catre baza de date. De exemplu sa fi existat acolo niste input-uri de unde user-ul nostru sa poata cere sa vizualizeze nr de elevi din clasa a 9-a B de exemplu sau sa poata vedea cati elevi au sub nota 5 la matematica, etc. Nu am mai apucat sa implementez si acest lucru.
