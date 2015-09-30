(test)

(test: value attr1: simple value attr2: json{"firstName":"John", "lastName":"Doe"} attr3: json[{"firstName":"John", "lastName":"Doe"},{"firstName":"Anna", "lastName":"Smith"},{"firstName":"Peter","lastName":"Jones"}] attr4: "simple value")

(test attr1: simple value attr2: json{"firstName":"John", "lastName":"Doe"} attr3: json[{"firstName":"John", "lastName":"Doe"},{"firstName":"Anna", "lastName":"Smith"},{"firstName":"Peter","lastName":"Jones"}] attr4: "simple value")

(test attr1: simple value attr2: json{"firstName":"John", "lastName":"Doe"} attr3: json[{"firstName":"John", "lastName":"Doe"},{"firstName":"Anna", "lastName":"Smith"},{"firstName":"Peter","lastName":"Jones"}] attr4: "simple value")
<pre>
  <code>
    [
      {"firstName":"John", "lastName":"Doe"},
      {"firstName":"Anna", "lastName":"Smith"},
      {"firstName":"Peter","lastName":"Jones"}
    ]
  </code>
</pre>
(/test)