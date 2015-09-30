# 0.3 (next release)

- Block function support now following values for the attribute name. `a-zA-Z0-9_-`
- Block function support now following value variants for the attribute value.
  - Simple attribute *Example:* `attr: simple text`
  - Between `""` *Example:* `attr: "simple text"`
  - Between `json{}` *Example:* `attr: json{"firstName":"John", "lastName":"Doe"}`
  - Between `json[]` *Example:* `attr: json[{"firstName":"John", "lastName":"Doe"},{"firstName":"Anna", "lastName":"Smith"},{"firstName":"Peter","lastName":"Jones"}]`
- Block function support now a JSON objects as value. *Example:* `attr: json{"firstName":"John", "lastName":"Doe"}`
- Block function support now a JSON array as value. *Example:* `attr: json[{"firstName":"John", "lastName":"Doe"},{"firstName":"Anna", "lastName":"Smith"},{"firstName":"Peter","lastName":"Jones"}]`

# 0.2

- Add licence file

# 0.1

- Initial version