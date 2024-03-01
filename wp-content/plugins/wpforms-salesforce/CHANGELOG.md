# Changelog
All notable changes to this project will be documented in this file and formatted via [this recommendation](https://keepachangelog.com/).

## [1.2.0] - 2022-09-20
### Added
- Salesforce "Currency" custom field can now be used when mapping form fields.

### Fixed
- Do not display errors and properly handle situations when no Salesforce account was selected but the form still saved and reloaded.

## [1.1.0] - 2022-05-26
### IMPORTANT
- Support for WordPress 5.1 has been discontinued. If you are running WordPress 5.1, you MUST upgrade WordPress before installing the new WPForms Salesforce. Failure to do that will disable the new WPForms Salesforce functionality.

### Added
- Compatibility with WPForms 1.6.7 and the updated Form Builder in 1.6.8.

### Changed
- Minimum WPForms version supported is 1.7.3.

### Fixed
- Compatibility with WordPress Multisite installations.
- Properly handle the situation when trying to change the template for the same form multiple times.
- Send to Salesforce form submission data even when the "Entry storage" option is disabled in the Form Builder.
- Various typos in the translatable strings reported by translators.

## [1.0.3] - 2020-12-24
### Fixed
- Incorrectly formatted mapped entry data values before sending them to Salesforce (`Cannot deserialize instance of *field_type*` error).

## [1.0.2] - 2020-12-10
### Fixed
- Access token not always refreshing when expired.
- Entries not sending to Salesforce in some edge cases.

## [1.0.1] - 2020-09-30
### Fixed
- Incorrect plugin build.

## [1.0.0] - 2020-09-24
- Initial release.
