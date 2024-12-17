(function (global, factory) {
    typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
    typeof define === 'function' && define.amd ? define(factory) :
    (global = global || self, global.FontPicker = factory());
  }(this, (function () { 'use strict';
  
    /*! *****************************************************************************
    Copyright (c) Microsoft Corporation. All rights reserved.
    Licensed under the Apache License, Version 2.0 (the "License"); you may not use
    this file except in compliance with the License. You may obtain a copy of the
    License at http://www.apache.org/licenses/LICENSE-2.0
  
    THIS CODE IS PROVIDED ON AN *AS IS* BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
    KIND, EITHER EXPRESS OR IMPLIED, INCLUDING WITHOUT LIMITATION ANY IMPLIED
    WARRANTIES OR CONDITIONS OF TITLE, FITNESS FOR A PARTICULAR PURPOSE,
    MERCHANTABLITY OR NON-INFRINGEMENT.
  
    See the Apache Version 2.0 License for specific language governing permissions
    and limitations under the License.
    ***************************************************************************** */
  
    var __assign = function() {
        __assign = Object.assign || function __assign(t) {
            for (var s, i = 1, n = arguments.length; i < n; i++) {
                s = arguments[i];
                for (var p in s) if (Object.prototype.hasOwnProperty.call(s, p)) t[p] = s[p];
            }
            return t;
        };
        return __assign.apply(this, arguments);
    };
  
    function __rest(s, e) {
        var t = {};
        for (var p in s) if (Object.prototype.hasOwnProperty.call(s, p) && e.indexOf(p) < 0)
            t[p] = s[p];
        if (s != null && typeof Object.getOwnPropertySymbols === "function")
            for (var i = 0, p = Object.getOwnPropertySymbols(s); i < p.length; i++) {
                if (e.indexOf(p[i]) < 0 && Object.prototype.propertyIsEnumerable.call(s, p[i]))
                    t[p[i]] = s[p[i]];
            }
        return t;
    }
  
    function __awaiter(thisArg, _arguments, P, generator) {
        return new (P || (P = Promise))(function (resolve, reject) {
            function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
            function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
            function step(result) { result.done ? resolve(result.value) : new P(function (resolve) { resolve(result.value); }).then(fulfilled, rejected); }
            step((generator = generator.apply(thisArg, _arguments || [])).next());
        });
    }
  
    function __generator(thisArg, body) {
        var _ = { label: 0, sent: function() { if (t[0] & 1) throw t[1]; return t[1]; }, trys: [], ops: [] }, f, y, t, g;
        return g = { next: verb(0), "throw": verb(1), "return": verb(2) }, typeof Symbol === "function" && (g[Symbol.iterator] = function() { return this; }), g;
        function verb(n) { return function (v) { return step([n, v]); }; }
        function step(op) {
            if (f) throw new TypeError("Generator is already executing.");
            while (_) try {
                if (f = 1, y && (t = op[0] & 2 ? y["return"] : op[0] ? y["throw"] || ((t = y["return"]) && t.call(y), 0) : y.next) && !(t = t.call(y, op[1])).done) return t;
                if (y = 0, t) op = [op[0] & 2, t.value];
                switch (op[0]) {
                    case 0: case 1: t = op; break;
                    case 4: _.label++; return { value: op[1], done: false };
                    case 5: _.label++; y = op[1]; op = [0]; continue;
                    case 7: op = _.ops.pop(); _.trys.pop(); continue;
                    default:
                        if (!(t = _.trys, t = t.length > 0 && t[t.length - 1]) && (op[0] === 6 || op[0] === 2)) { _ = 0; continue; }
                        if (op[0] === 3 && (!t || (op[1] > t[0] && op[1] < t[3]))) { _.label = op[1]; break; }
                        if (op[0] === 6 && _.label < t[1]) { _.label = t[1]; t = op; break; }
                        if (t && _.label < t[2]) { _.label = t[2]; _.ops.push(op); break; }
                        if (t[2]) _.ops.pop();
                        _.trys.pop(); continue;
                }
                op = body.call(thisArg, _);
            } catch (e) { op = [6, e]; y = 0; } finally { f = t = 0; }
            if (op[0] & 5) throw op[1]; return { value: op[0] ? op[1] : void 0, done: true };
        }
    }
  
    function styleInject(css, ref) {
      if ( ref === void 0 ) ref = {};
      var insertAt = ref.insertAt;
  
      if (!css || typeof document === 'undefined') { return; }
  
      var head = document.head || document.getElementsByTagName('head')[0];
      var style = document.createElement('style');
      style.type = 'text/css';
  
      if (insertAt === 'top') {
        if (head.firstChild) {
          head.insertBefore(style, head.firstChild);
        } else {
          head.appendChild(style);
        }
      } else {
        head.appendChild(style);
      }
  
      if (style.styleSheet) {
        style.styleSheet.cssText = css;
      } else {
        style.appendChild(document.createTextNode(css));
      }
    }
  
    var css = "@charset \"UTF-8\";\ndiv[id^=font-picker] {\n  position: relative;\n  display: inline-block;\n  width: 200px;\n  box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);\n}\ndiv[id^=font-picker] * {\n  box-sizing: border-box;\n}\ndiv[id^=font-picker] p {\n  margin: 0;\n  padding: 0;\n}\ndiv[id^=font-picker] button {\n  color: inherit;\n  font-size: inherit;\n  background: none;\n  border: 0;\n  outline: none;\n  cursor: pointer;\n}\ndiv[id^=font-picker] .dropdown-button {\n  display: flex;\n  align-items: center;\n  justify-content: space-between;\n  width: 100%;\n  height: 35px;\n  padding: 0 10px;\n  background: #cbcbcb;\n}\ndiv[id^=font-picker] .dropdown-button:hover, div[id^=font-picker] .dropdown-button:focus {\n  background: #bebebe;\n}\ndiv[id^=font-picker] .dropdown-button .dropdown-font-name {\n  overflow: hidden;\n  white-space: nowrap;\n}\ndiv[id^=font-picker] .dropdown-icon {\n  margin-left: 10px;\n}\n@-webkit-keyframes spinner {\n  to {\n    transform: rotate(360deg);\n  }\n}\n@keyframes spinner {\n  to {\n    transform: rotate(360deg);\n  }\n}\ndiv[id^=font-picker] .dropdown-icon.loading::before {\n  display: block;\n  width: 10px;\n  height: 10px;\n  border: 2px solid #b2b2b2;\n  border-top-color: #000000;\n  border-radius: 50%;\n  -webkit-animation: spinner 0.6s linear infinite;\n          animation: spinner 0.6s linear infinite;\n  content: \"\";\n}\ndiv[id^=font-picker] .dropdown-icon.finished::before {\n  display: block;\n  width: 0;\n  height: 0;\n  margin: 0 2px;\n  border-top: 6px solid #000000;\n  border-right: 5px solid transparent;\n  border-left: 5px solid transparent;\n  transition: transform 0.3s;\n  content: \"\";\n}\ndiv[id^=font-picker] .dropdown-icon.error::before {\n  content: \"⚠\";\n}\ndiv[id^=font-picker].expanded .dropdown-icon.finished::before {\n  transform: rotate(-180deg);\n}\ndiv[id^=font-picker].expanded ul {\n  max-height: 200px;\n}\ndiv[id^=font-picker] ul {\n  position: absolute;\n  z-index: 1;\n  width: 100%;\n  max-height: 0;\n  margin: 0;\n  padding: 0;\n  overflow-x: hidden;\n  overflow-y: auto;\n  background: #eaeaea;\n  box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);\n  transition: 0.3s;\n  -webkit-overflow-scrolling: touch;\n}\ndiv[id^=font-picker] ul li {\n  height: 35px;\n  list-style: none;\n}\ndiv[id^=font-picker] ul li button {\n  display: flex;\n  align-items: center;\n  width: 100%;\n  height: 100%;\n  padding: 0 10px;\n  white-space: nowrap;\n}\ndiv[id^=font-picker] ul li button:hover, div[id^=font-picker] ul li button:focus {\n  background: #dddddd;\n}\ndiv[id^=font-picker] ul li button.active-font {\n  background: #d1d1d1;\n}";
    styleInject(css);
  
    function getFontId(fontFamily) {
        return fontFamily.replace(/\s+/g, "-").toLowerCase();
    }
    function validatePickerId(pickerId) {
        if (pickerId.match(/[^0-9a-z]/i)) {
            throw Error("The `pickerId` parameter may only contain letters and digits");
        }
    }
  
    function get(url) {
        return new Promise(function (resolve, reject) {
            var request = new XMLHttpRequest();
            request.overrideMimeType("application/json");
            request.open("GET", url, true);
            request.onreadystatechange = function () {
                if (request.readyState === 4) {
                    if (request.status !== 200) {
                        reject(new Error("Response has status code " + request.status));
                    }
                    else {
                        resolve(request.responseText);
                    }
                }
            };
            request.send();
        });
    }
  
    var LIST_BASE_URL = "https://www.googleapis.com/webfonts/v1/webfonts";
    function getFontList(apiKey) {
        return __awaiter(this, void 0, void 0, function () {
            var url, response, json, fontsOriginal;
            return __generator(this, function (_a) {
                switch (_a.label) {
                    case 0:
                        url = new URL(LIST_BASE_URL);
                        url.searchParams.append("sort", "popularity");
                        url.searchParams.append("key", apiKey);
                        return [4, get(url.href)];
                    case 1:
                        response = _a.sent();
                        json = JSON.parse(response);
                        fontsOriginal = json.items;
                        return [2, fontsOriginal.map(function (fontOriginal) {
                                var family = fontOriginal.family, subsets = fontOriginal.subsets, others = __rest(fontOriginal, ["family", "subsets"]);
                                return __assign(__assign({}, others), { family: family, id: getFontId(family), scripts: subsets });
                            })];
                }
            });
        });
    }
  
    var previewFontsStylesheet = document.createElement("style");
    document.head.appendChild(previewFontsStylesheet);
    function applyFontPreview(previewFont, selectorSuffix) {
        var fontId = getFontId(previewFont.family);
        var style = "\n\t\t\t#font-button-" + fontId + selectorSuffix + " {\n\t\t\t\tfont-family: \"" + previewFont.family + "\";\n\t\t\t}\n\t\t";
        previewFontsStylesheet.appendChild(document.createTextNode(style));
    }
    function getActiveFontStylesheet(selectorSuffix) {
        var stylesheetId = "active-font-" + selectorSuffix;
        var activeFontStylesheet = document.getElementById(stylesheetId);
        if (!activeFontStylesheet) {
            activeFontStylesheet = document.createElement("style");
            activeFontStylesheet.id = stylesheetId;
            document.head.appendChild(activeFontStylesheet);
        }
        return activeFontStylesheet;
    }
    function applyActiveFont(activeFont, previousFontFamily, selectorSuffix) {
        var style = "\n\t\t.apply-font" + selectorSuffix + " {\n\t\t\tfont-family: \"" + activeFont.family + "\"" + (previousFontFamily ? ", \"" + previousFontFamily + "\"" : "") + ";\n\t\t}\n\t";
        var activeFontStylesheet = getActiveFontStylesheet(selectorSuffix);
        activeFontStylesheet.innerHTML = style;
    }
  
    var PREVIEW_ATTRIBUTE_NAME = "data-is-preview";
    function getStylesheetId(fontId) {
        return "font-" + fontId;
    }
    function stylesheetExists(fontId, isPreview) {
        var stylesheetNode = document.getElementById(getStylesheetId(fontId));
        if (isPreview === null || isPreview === undefined) {
            return stylesheetNode !== null;
        }
        return (stylesheetNode !== null &&
            stylesheetNode.getAttribute(PREVIEW_ATTRIBUTE_NAME) === isPreview.toString());
    }
    function createStylesheet(fontId, isPreview) {
        var stylesheetNode = document.createElement("style");
        stylesheetNode.id = getStylesheetId(fontId);
        stylesheetNode.setAttribute(PREVIEW_ATTRIBUTE_NAME, isPreview.toString());
        document.head.appendChild(stylesheetNode);
    }
    function fillStylesheet(fontId, styles) {
        var stylesheetId = getStylesheetId(fontId);
        var stylesheetNode = document.getElementById(stylesheetId);
        if (stylesheetNode) {
            stylesheetNode.textContent = styles;
        }
        else {
            console.error("Could not fill stylesheet: Stylesheet with ID \"" + stylesheetId + "\" not found");
        }
    }
    function setStylesheetType(fontId, isPreview) {
        var stylesheetId = getStylesheetId(fontId);
        var stylesheetNode = document.getElementById(stylesheetId);
        if (stylesheetNode) {
            stylesheetNode.setAttribute(PREVIEW_ATTRIBUTE_NAME, isPreview.toString());
        }
        else {
            console.error("Could not change stylesheet type: Stylesheet with ID \"" + stylesheetId + "\" not found");
        }
    }
  
    function getMatches(regex, str) {
        var matches = [];
        var match;
        do {
            match = regex.exec(str);
            if (match) {
                matches.push(match[1]);
            }
        } while (match);
        return matches;
    }
  
    var FONT_FACE_REGEX = /@font-face {([\s\S]*?)}/gm;
    var FONT_FAMILY_REGEX = /font-family: ['"](.*?)['"]/gm;
    function extractFontStyles(allFontStyles) {
        var rules = getMatches(FONT_FACE_REGEX, allFontStyles);
        var fontStyles = {};
        rules.forEach(function (rule) {
            var fontFamily = getMatches(FONT_FAMILY_REGEX, rule)[0];
            var fontId = getFontId(fontFamily);
            if (!(fontId in fontStyles)) {
                fontStyles[fontId] = "";
            }
            fontStyles[fontId] += "@font-face {\n" + rule + "\n}\n\n";
        });
        return fontStyles;
    }
  
    var FONT_BASE_URL = "https://fonts.googleapis.com/css";
    function getStylesheet(fonts, scripts, variants, previewsOnly) {
        return __awaiter(this, void 0, void 0, function () {
            var url, variantsStr, familiesStr, familyNamesConcat, downloadChars;
            return __generator(this, function (_a) {
                url = new URL(FONT_BASE_URL);
                variantsStr = variants.join(",");
                familiesStr = fonts.map(function (font) { return font.family + ":" + variantsStr; });
                url.searchParams.append("family", familiesStr.join("|"));
                url.searchParams.append("subset", scripts.join(","));
                if (previewsOnly) {
                    familyNamesConcat = fonts.map(function (font) { return font.family; }).join("");
                    downloadChars = familyNamesConcat
                        .split("")
                        .filter(function (char, pos, self) { return self.indexOf(char) === pos; })
                        .join("");
                    url.searchParams.append("text", downloadChars);
                }
                url.searchParams.append("font-display", "swap");
                return [2, get(url.href)];
            });
        });
    }
  
    function loadFontPreviews(fonts, scripts, variants, selectorSuffix) {
        return __awaiter(this, void 0, void 0, function () {
            var fontsArray, fontsToFetch, response, fontStyles;
            return __generator(this, function (_a) {
                switch (_a.label) {
                    case 0:
                        fontsArray = Array.from(fonts.values());
                        fontsToFetch = fontsArray
                            .map(function (font) { return font.id; })
                            .filter(function (fontId) { return !stylesheetExists(fontId); });
                        fontsToFetch.forEach(function (fontId) { return createStylesheet(fontId, true); });
                        return [4, getStylesheet(fontsArray, scripts, variants, true)];
                    case 1:
                        response = _a.sent();
                        fontStyles = extractFontStyles(response);
                        fontsArray.forEach(function (font) {
                            applyFontPreview(font, selectorSuffix);
                            if (fontsToFetch.includes(font.id)) {
                                if (!(font.id in fontStyles)) {
                                    console.error("Missing styles for font \"" + font.family + "\" (fontId \"" + font.id + "\") in Google Fonts response");
                                    return;
                                }
                                fillStylesheet(font.id, fontStyles[font.id]);
                            }
                        });
                        return [2];
                }
            });
        });
    }
    function loadActiveFont(font, previousFontFamily, scripts, variants, selectorSuffix) {
        return __awaiter(this, void 0, void 0, function () {
            var fontStyle;
            return __generator(this, function (_a) {
                switch (_a.label) {
                    case 0:
                        if (!stylesheetExists(font.id, false)) return [3, 1];
                        applyActiveFont(font, previousFontFamily, selectorSuffix);
                        return [3, 3];
                    case 1:
                        if (stylesheetExists(font.id, true)) {
                            setStylesheetType(font.id, false);
                        }
                        else {
                            createStylesheet(font.id, false);
                        }
                        return [4, getStylesheet([font], scripts, variants, false)];
                    case 2:
                        fontStyle = _a.sent();
                        applyActiveFont(font, previousFontFamily, selectorSuffix);
                        fillStylesheet(font.id, fontStyle);
                        _a.label = 3;
                    case 3: return [2];
                }
            });
        });
    }
  
    var FONT_FAMILY_DEFAULT = "Open Sans";
    var OPTIONS_DEFAULTS = {
        pickerId: "",
        families: [],
        categories: [],
        scripts: ["latin"],
        variants: ["regular"],
        filter: function () { return true; },
        limit: 50,
        sort: "alphabet",
    };
  
    var FontManager = (function () {
        function FontManager(apiKey, defaultFamily, _a, onChange) {
            if (defaultFamily === void 0) { defaultFamily = FONT_FAMILY_DEFAULT; }
            var _b = _a.pickerId, pickerId = _b === void 0 ? OPTIONS_DEFAULTS.pickerId : _b, _c = _a.families, families = _c === void 0 ? OPTIONS_DEFAULTS.families : _c, _d = _a.categories, categories = _d === void 0 ? OPTIONS_DEFAULTS.categories : _d, _e = _a.scripts, scripts = _e === void 0 ? OPTIONS_DEFAULTS.scripts : _e, _f = _a.variants, variants = _f === void 0 ? OPTIONS_DEFAULTS.variants : _f, _g = _a.filter, filter = _g === void 0 ? OPTIONS_DEFAULTS.filter : _g, _h = _a.limit, limit = _h === void 0 ? OPTIONS_DEFAULTS.limit : _h, _j = _a.sort, sort = _j === void 0 ? OPTIONS_DEFAULTS.sort : _j;
            if (onChange === void 0) { onChange = function () { }; }
            this.fonts = new Map();
            validatePickerId(pickerId);
            this.selectorSuffix = pickerId ? "-" + pickerId : "";
            this.apiKey = apiKey;
            this.options = {
                pickerId: pickerId,
                families: families,
                categories: categories,
                scripts: scripts,
                variants: variants,
                filter: filter,
                limit: limit,
                sort: sort,
            };
            this.onChange = onChange;
            this.addFont(defaultFamily, false);
            this.setActiveFont(defaultFamily, false);
        }
        FontManager.prototype.init = function () {
            return __awaiter(this, void 0, void 0, function () {
                var fonts, _loop_1, this_1, i, state_1, fontsToLoad;
                return __generator(this, function (_a) {
                    switch (_a.label) {
                        case 0: return [4, getFontList(this.apiKey)];
                        case 1:
                            fonts = _a.sent();
                            _loop_1 = function (i) {
                                var font = fonts[i];
                                if (this_1.fonts.size >= this_1.options.limit) {
                                    return "break";
                                }
                                if (!this_1.fonts.has(font.family) &&
                                    (this_1.options.families.length === 0 || this_1.options.families.includes(font.family)) &&
                                    (this_1.options.categories.length === 0 || this_1.options.categories.includes(font.category)) &&
                                    this_1.options.scripts.every(function (script) { return font.scripts.includes(script); }) &&
                                    this_1.options.variants.every(function (variant) { return font.variants.includes(variant); }) &&
                                    this_1.options.filter(font) === true) {
                                    this_1.fonts.set(font.family, font);
                                }
                            };
                            this_1 = this;
                            for (i = 0; i < fonts.length; i += 1) {
                                state_1 = _loop_1(i);
                                if (state_1 === "break")
                                    break;
                            }
                            fontsToLoad = new Map(this.fonts);
                            fontsToLoad["delete"](this.activeFontFamily);
                            loadFontPreviews(fontsToLoad, this.options.scripts, this.options.variants, this.selectorSuffix);
                            return [2, this.fonts];
                    }
                });
            });
        };
        FontManager.prototype.getFonts = function () {
            return this.fonts;
        };
        FontManager.prototype.addFont = function (fontFamily, downloadPreview) {
            if (downloadPreview === void 0) { downloadPreview = true; }
            var font = {
                family: fontFamily,
                id: getFontId(fontFamily),
            };
            this.fonts.set(fontFamily, font);
            if (downloadPreview) {
                var fontMap = new Map();
                fontMap.set(fontFamily, font);
                loadFontPreviews(fontMap, this.options.scripts, this.options.variants, this.selectorSuffix);
            }
        };
        FontManager.prototype.removeFont = function (fontFamily) {
            this.fonts["delete"](fontFamily);
        };
        FontManager.prototype.getActiveFont = function () {
            var activeFont = this.fonts.get(this.activeFontFamily);
            if (!activeFont) {
                throw Error("Cannot get active font: \"" + this.activeFontFamily + "\" is not in the font list");
            }
            else {
                return activeFont;
            }
        };
        FontManager.prototype.setActiveFont = function (fontFamily, runOnChange) {
            var _this = this;
            if (runOnChange === void 0) { runOnChange = true; }
            var previousFontFamily = this.activeFontFamily;
            var activeFont = this.fonts.get(fontFamily);
            if (!activeFont) {
                throw Error("Cannot update active font: \"" + fontFamily + "\" is not in the font list");
            }
            this.activeFontFamily = fontFamily;
            loadActiveFont(activeFont, previousFontFamily, this.options.scripts, this.options.variants, this.selectorSuffix).then(function () {
                if (runOnChange) {
                    _this.onChange(activeFont);
                }
            });
        };
        FontManager.prototype.setOnChange = function (onChange) {
            this.onChange = onChange;
        };
        return FontManager;
    }());
  
    var FontPicker = (function () {
        function FontPicker(apiKey, defaultFamily, _a, onChange) {
            if (defaultFamily === void 0) { defaultFamily = FONT_FAMILY_DEFAULT; }
            var _b = _a.pickerId, pickerId = _b === void 0 ? OPTIONS_DEFAULTS.pickerId : _b, _c = _a.families, families = _c === void 0 ? OPTIONS_DEFAULTS.families : _c, _d = _a.categories, categories = _d === void 0 ? OPTIONS_DEFAULTS.categories : _d, _e = _a.scripts, scripts = _e === void 0 ? OPTIONS_DEFAULTS.scripts : _e, _f = _a.variants, variants = _f === void 0 ? OPTIONS_DEFAULTS.variants : _f, _g = _a.filter, filter = _g === void 0 ? OPTIONS_DEFAULTS.filter : _g, _h = _a.limit, limit = _h === void 0 ? OPTIONS_DEFAULTS.limit : _h, _j = _a.sort, sort = _j === void 0 ? OPTIONS_DEFAULTS.sort : _j;
            if (onChange === void 0) { onChange = function () { }; }
            this.expanded = false;
            this.closeEventListener = this.closeEventListener.bind(this);
            this.toggleExpanded = this.toggleExpanded.bind(this);
            var options = {
                pickerId: pickerId,
                families: families,
                categories: categories,
                scripts: scripts,
                variants: variants,
                filter: filter,
                limit: limit,
                sort: sort,
            };
            this.fontManager = new FontManager(apiKey, defaultFamily, options, onChange);
            this.generateUI(sort);
        }
        FontPicker.prototype.generateUI = function (sort) {
            var _this = this;
            var selectorSuffix = this.fontManager.selectorSuffix;
            var pickerId = "font-picker" + selectorSuffix;
            this.fontPickerDiv = document.getElementById(pickerId);
            if (!this.fontPickerDiv) {
                throw Error("Missing div with id=\"" + pickerId + "\"");
            }
            var dropdownButton = document.createElement("button");
            dropdownButton.classList.add("dropdown-button");
            dropdownButton.onclick = this.toggleExpanded;
            dropdownButton.onkeypress = this.toggleExpanded;
            dropdownButton.type = "button";
            this.fontPickerDiv.appendChild(dropdownButton);
            this.dropdownFamily = document.createElement("p");
            this.dropdownFamily.textContent = this.fontManager.getActiveFont().family;
            this.dropdownFamily.classList.add("dropdown-font-family");
            dropdownButton.appendChild(this.dropdownFamily);
            var dropdownIcon = document.createElement("p");
            dropdownIcon.classList.add("dropdown-icon", "loading");
            dropdownButton.appendChild(dropdownIcon);
            this.fontManager
                .init()
                .then(function (fontMap) {
                var fonts = Array.from(fontMap.values());
                if (sort === "alphabet") {
                    fonts.sort(function (font1, font2) {
                        return font1.family.localeCompare(font2.family);
                    });
                }
                _this.generateFontList(fonts);
                dropdownIcon.classList.replace("loading", "finished");
            })["catch"](function (err) {
                dropdownIcon.classList.replace("loading", "error");
                console.error("Error trying to fetch the list of available fonts");
                console.error(err);
            });
        };
        FontPicker.prototype.generateFontList = function (fonts) {
            var _this = this;
            this.ul = document.createElement("ul");
            this.ul.classList.add("font-list");
            fonts.forEach(function (font) {
                _this.addFontLi(font);
            });
            this.fontPickerDiv.appendChild(this.ul);
            var activeFontFamily = this.fontManager.getActiveFont().family;
            var activeFontId = getFontId(activeFontFamily);
            var fontButtonId = "font-button-" + activeFontId + this.fontManager.selectorSuffix;
            this.activeFontButton = document.getElementById(fontButtonId);
            if (this.activeFontButton) {
                this.activeFontButton.classList.add("active-font");
            }
            else {
                console.error("Could not find font button with ID (" + fontButtonId + ")");
            }
        };
        FontPicker.prototype.addFontLi = function (font, listIndex) {
            var _this = this;
            var fontId = getFontId(font.family);
            var li = document.createElement("li");
            li.classList.add("font-list-item");
            var fontButton = document.createElement("button");
            fontButton.type = "button";
            fontButton.id = "font-button-" + fontId + this.fontManager.selectorSuffix;
            fontButton.classList.add("font-button");
            fontButton.textContent = font.family;
            var onActivate = function () {
                _this.toggleExpanded();
                _this.setActiveFont(font.family);
            };
            fontButton.onclick = onActivate;
            fontButton.onkeypress = onActivate;
            li.appendChild(fontButton);
            if (listIndex) {
                this.ul.insertBefore(li, this.ul.children[listIndex]);
            }
            else {
                this.ul.appendChild(li);
            }
        };
        FontPicker.prototype.closeEventListener = function (e) {
            var targetEl = e.target;
            var fontPickerEl = document.getElementById("font-picker" + this.fontManager.selectorSuffix);
            while (true) {
                if (targetEl === fontPickerEl) {
                    return;
                }
                if (targetEl.parentNode) {
                    targetEl = targetEl.parentNode;
                }
                else {
                    this.toggleExpanded();
                    return;
                }
            }
        };
        FontPicker.prototype.toggleExpanded = function () {
            if (this.expanded) {
                this.expanded = false;
                this.fontPickerDiv.classList.remove("expanded");
                document.removeEventListener("click", this.closeEventListener);
            }
            else {
                this.expanded = true;
                this.fontPickerDiv.classList.add("expanded");
                document.addEventListener("click", this.closeEventListener);
            }
        };
        FontPicker.prototype.getFonts = function () {
            return this.fontManager.getFonts();
        };
        FontPicker.prototype.addFont = function (fontFamily, index) {
            if (Array.from(this.fontManager.getFonts().keys()).includes(fontFamily)) {
                throw Error("Did not add font to font picker: Font family \"" + fontFamily + "\" is already in the list");
            }
            this.fontManager.addFont(fontFamily, true);
            var font = this.fontManager.getFonts().get(fontFamily);
            if (font) {
                this.addFontLi(font, index);
            }
            else {
                console.error("Font \"" + fontFamily + "\" is missing in font list");
            }
        };
        FontPicker.prototype.removeFont = function (fontFamily) {
            this.fontManager.removeFont(fontFamily);
            var fontId = getFontId(fontFamily);
            var fontButton = document.getElementById("font-button-" + fontId + this.fontManager.selectorSuffix);
            if (fontButton) {
                var fontLi = fontButton.parentElement;
                fontButton.remove();
                if (fontLi) {
                    fontLi.remove();
                }
            }
            else {
                throw Error("Could not remove font from font picker: Font family \"" + fontFamily + "\" is not in the list");
            }
        };
        FontPicker.prototype.getActiveFont = function () {
            return this.fontManager.getActiveFont();
        };
        FontPicker.prototype.setActiveFont = function (fontFamily) {
            this.fontManager.setActiveFont(fontFamily);
            var fontId = getFontId(fontFamily);
            this.dropdownFamily.textContent = fontFamily;
            if (this.activeFontButton) {
                this.activeFontButton.classList.remove("active-font");
                this.activeFontButton = document.getElementById("font-button-" + fontId + this.fontManager.selectorSuffix);
                this.activeFontButton.classList.add("active-font");
            }
            else {
                console.error("`activeFontButton` is undefined");
            }
        };
        FontPicker.prototype.setOnChange = function (onChange) {
            this.fontManager.setOnChange(onChange);
        };
        return FontPicker;
    }());
  
    return FontPicker;
  
  })));
//
// jQuery MiniColors: A tiny color picker built on jQuery
//
// Developed by Cory LaViska for A Beautiful Site, LLC
//
// Licensed under the MIT license: http://opensource.org/licenses/MIT
//
(function (factory) {
  if(typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module.
    define(['jquery'], factory);
  } else if(typeof exports === 'object') {
    // Node/CommonJS
    module.exports = factory(require('jquery'));
  } else {
    // Browser globals
    factory(jQuery);
  }
}(function ($) {
  'use strict';

  // Defaults
  $.minicolors = {
    defaults: {
      animationSpeed: 50,
      animationEasing: 'swing',
      change: null,
      changeDelay: 0,
      control: 'hue',
      defaultValue: '',
      format: 'hex',
      hide: null,
      hideSpeed: 100,
      inline: false,
      keywords: '',
      letterCase: 'lowercase',
      opacity: false,
      position: 'bottom',
      show: null,
      showSpeed: 100,
      theme: 'default',
      swatches: []
    }
  };

  // Public methods
  $.extend($.fn, {
    minicolors: function(method, data) {

      switch(method) {
        // Destroy the control
        case 'destroy':
          $(this).each(function() {
            destroy($(this));
          });
          return $(this);

        // Hide the color picker
        case 'hide':
          hide();
          return $(this);

        // Get/set opacity
        case 'opacity':
          // Getter
          if(data === undefined) {
            // Getter
            return $(this).attr('data-opacity');
          } else {
            // Setter
            $(this).each(function() {
              updateFromInput($(this).attr('data-opacity', data));
            });
          }
          return $(this);

        // Get an RGB(A) object based on the current color/opacity
        case 'rgbObject':
          return rgbObject($(this), method === 'rgbaObject');

        // Get an RGB(A) string based on the current color/opacity
        case 'rgbString':
        case 'rgbaString':
          return rgbString($(this), method === 'rgbaString');

        // Get/set settings on the fly
        case 'settings':
          if(data === undefined) {
            return $(this).data('minicolors-settings');
          } else {
            // Setter
            $(this).each(function() {
              var settings = $(this).data('minicolors-settings') || {};
              destroy($(this));
              $(this).minicolors($.extend(true, settings, data));
            });
          }
          return $(this);

        // Show the color picker
        case 'show':
          show($(this).eq(0));
          return $(this);

        // Get/set the hex color value
        case 'value':
          if(data === undefined) {
            // Getter
            return $(this).val();
          } else {
            // Setter
            $(this).each(function() {
              if(typeof(data) === 'object' && data !== null) {
                if(data.opacity !== undefined) {
                  $(this).attr('data-opacity', keepWithin(data.opacity, 0, 1));
                }
                if(data.color) {
                  $(this).val(data.color);
                }
              } else {
                $(this).val(data);
              }
              updateFromInput($(this));
            });
          }
          return $(this);

        // Initializes the control
        default:
          if(method !== 'create') data = method;
          $(this).each(function() {
            init($(this), data);
          });
          return $(this);

      }

    }
  });

  // Initialize input elements
  function init(input, settings) {
    var minicolors = $('<div class="minicolors" />');
    var defaults = $.minicolors.defaults;
    var name;
    var size;
    var swatches;
    var swatch;
    var swatchString;
    var panel;
    var i;

    // Do nothing if already initialized
    if(input.data('minicolors-initialized')) return;

    // Handle settings
    settings = $.extend(true, {}, defaults, settings);

    // The wrapper
    minicolors
      .addClass('minicolors-theme-' + settings.theme)
      .toggleClass('minicolors-with-opacity', settings.opacity);

    // Custom positioning
    if(settings.position !== undefined) {
      $.each(settings.position.split(' '), function() {
        minicolors.addClass('minicolors-position-' + this);
      });
    }

    // Input size
    if(settings.format === 'rgb') {
      size = settings.opacity ? '25' : '20';
    } else {
      size = settings.keywords ? '11' : '7';
    }

    // The input
    input
      .addClass('minicolors-input')
      .data('minicolors-initialized', false)
      .data('minicolors-settings', settings)
      .prop('size', size)
      .wrap(minicolors)
      .after(
        '<div class="minicolors-panel minicolors-slider-' + settings.control + '">' +
                '<div class="minicolors-slider minicolors-sprite">' +
                  '<div class="minicolors-picker"></div>' +
                '</div>' +
                '<div class="minicolors-opacity-slider minicolors-sprite">' +
                  '<div class="minicolors-picker"></div>' +
                '</div>' +
                '<div class="minicolors-grid minicolors-sprite">' +
                  '<div class="minicolors-grid-inner"></div>' +
                  '<div class="minicolors-picker"><div></div></div>' +
                '</div>' +
              '</div>'
      );

    // The swatch
    if(!settings.inline) {
      input.after('<span class="minicolors-swatch minicolors-sprite minicolors-input-swatch"><span class="minicolors-swatch-color"></span></span>');
      input.next('.minicolors-input-swatch').on('click', function(event) {
        event.preventDefault();
        input.trigger('focus');
      });
    }

    // Prevent text selection in IE
    panel = input.parent().find('.minicolors-panel');
    panel.on('selectstart', function() { return false; }).end();

    // Swatches
    if(settings.swatches && settings.swatches.length !== 0) {
      panel.addClass('minicolors-with-swatches');
      swatches = $('<ul class="minicolors-swatches"></ul>')
        .appendTo(panel);
      for(i = 0; i < settings.swatches.length; ++i) {
        // allow for custom objects as swatches
        if(typeof settings.swatches[i] === 'object') {
          name = settings.swatches[i].name;
          swatch = settings.swatches[i].color;
        } else {
          name = '';
          swatch = settings.swatches[i];
        }
        swatchString = swatch;
        swatch = isRgb(swatch) ? parseRgb(swatch, true) : hex2rgb(parseHex(swatch, true));
        $('<li class="minicolors-swatch minicolors-sprite"><span class="minicolors-swatch-color"></span></li>')
          .attr("title", name)
          .appendTo(swatches)
          .data('swatch-color', swatchString)
          .find('.minicolors-swatch-color')
          .css({
            backgroundColor: ((swatchString !== 'transparent') ? rgb2hex(swatch) : 'transparent'),
            opacity: String(swatch.a)
          });
        settings.swatches[i] = swatch;
      }
    }

    // Inline controls
    if(settings.inline) input.parent().addClass('minicolors-inline');

    updateFromInput(input, false);

    input.data('minicolors-initialized', true);
  }

  // Returns the input back to its original state
  function destroy(input) {
    var minicolors = input.parent();

    // Revert the input element
    input
      .removeData('minicolors-initialized')
      .removeData('minicolors-settings')
      .removeProp('size')
      .removeClass('minicolors-input');

    // Remove the wrap and destroy whatever remains
    minicolors.before(input).remove();
  }

  // Shows the specified dropdown panel
  function show(input) {
    var minicolors = input.parent();
    var panel = minicolors.find('.minicolors-panel');
    var settings = input.data('minicolors-settings');

    // Do nothing if uninitialized, disabled, inline, or already open
    if(
      !input.data('minicolors-initialized') ||
      input.prop('disabled') ||
      minicolors.hasClass('minicolors-inline') ||
      minicolors.hasClass('minicolors-focus')
    ) return;

    hide();

    minicolors.addClass('minicolors-focus');
    if (panel.animate) {
      panel
        .stop(true, true)
        .fadeIn(settings.showSpeed, function () {
          if (settings.show) settings.show.call(input.get(0));
        });
    } else {
      panel.show();
      if (settings.show) settings.show.call(input.get(0));
    }
  }

  // Hides all dropdown panels
  function hide() {
    $('.minicolors-focus').each(function() {
      var minicolors = $(this);
      var input = minicolors.find('.minicolors-input');
      var panel = minicolors.find('.minicolors-panel');
      var settings = input.data('minicolors-settings');

      if (panel.animate) {
        panel.fadeOut(settings.hideSpeed, function () {
          if (settings.hide) settings.hide.call(input.get(0));
          minicolors.removeClass('minicolors-focus');
        });
      } else {
        panel.hide();
        if (settings.hide) settings.hide.call(input.get(0));
        minicolors.removeClass('minicolors-focus');
      }
    });
  }

  // Moves the selected picker
  function move(target, event, animate) {
    var input = target.parents('.minicolors').find('.minicolors-input');
    var settings = input.data('minicolors-settings');
    var picker = target.find('[class$=-picker]');
    var offsetX = target.offset().left;
    var offsetY = target.offset().top;
    var x = Math.round(event.pageX - offsetX);
    var y = Math.round(event.pageY - offsetY);
    var duration = animate ? settings.animationSpeed : 0;
    var wx, wy, r, phi, styles;

    // Touch support
    if(event.originalEvent.changedTouches) {
      x = event.originalEvent.changedTouches[0].pageX - offsetX;
      y = event.originalEvent.changedTouches[0].pageY - offsetY;
    }

    // Constrain picker to its container
    if(x < 0) x = 0;
    if(y < 0) y = 0;
    if(x > target.width()) x = target.width();
    if(y > target.height()) y = target.height();

    // Constrain color wheel values to the wheel
    if(target.parent().is('.minicolors-slider-wheel') && picker.parent().is('.minicolors-grid')) {
      wx = 75 - x;
      wy = 75 - y;
      r = Math.sqrt(wx * wx + wy * wy);
      phi = Math.atan2(wy, wx);
      if(phi < 0) phi += Math.PI * 2;
      if(r > 75) {
        r = 75;
        x = 75 - (75 * Math.cos(phi));
        y = 75 - (75 * Math.sin(phi));
      }
      x = Math.round(x);
      y = Math.round(y);
    }

    // Move the picker
    styles = {
      top: y + 'px'
    };
    if(target.is('.minicolors-grid')) {
      styles.left = x + 'px';
    }
    if (picker.animate) {
      picker
        .stop(true)
        .animate(styles, duration, settings.animationEasing, function() {
          updateFromControl(input, target);
        });
    } else {
      picker
        .css(styles);
      updateFromControl(input, target);
    }
  }

  // Sets the input based on the color picker values
  function updateFromControl(input, target) {

    function getCoords(picker, container) {
      var left, top;
      if(!picker.length || !container) return null;
      left = picker.offset().left;
      top = picker.offset().top;

      return {
        x: left - container.offset().left + (picker.outerWidth() / 2),
        y: top - container.offset().top + (picker.outerHeight() / 2)
      };
    }

    var hue, saturation, brightness, x, y, r, phi;
    var hex = input.val();
    var opacity = input.attr('data-opacity');

    // Helpful references
    var minicolors = input.parent();
    var settings = input.data('minicolors-settings');
    var swatch = minicolors.find('.minicolors-input-swatch');

    // Panel objects
    var grid = minicolors.find('.minicolors-grid');
    var slider = minicolors.find('.minicolors-slider');
    var opacitySlider = minicolors.find('.minicolors-opacity-slider');

    // Picker objects
    var gridPicker = grid.find('[class$=-picker]');
    var sliderPicker = slider.find('[class$=-picker]');
    var opacityPicker = opacitySlider.find('[class$=-picker]');

    // Picker positions
    var gridPos = getCoords(gridPicker, grid);
    var sliderPos = getCoords(sliderPicker, slider);
    var opacityPos = getCoords(opacityPicker, opacitySlider);

    // Handle colors
    if(target.is('.minicolors-grid, .minicolors-slider, .minicolors-opacity-slider')) {

      // Determine HSB values
      switch(settings.control) {
        case 'wheel':
          // Calculate hue, saturation, and brightness
          x = (grid.width() / 2) - gridPos.x;
          y = (grid.height() / 2) - gridPos.y;
          r = Math.sqrt(x * x + y * y);
          phi = Math.atan2(y, x);
          if(phi < 0) phi += Math.PI * 2;
          if(r > 75) {
            r = 75;
            gridPos.x = 69 - (75 * Math.cos(phi));
            gridPos.y = 69 - (75 * Math.sin(phi));
          }
          saturation = keepWithin(r / 0.75, 0, 100);
          hue = keepWithin(phi * 180 / Math.PI, 0, 360);
          brightness = keepWithin(100 - Math.floor(sliderPos.y * (100 / slider.height())), 0, 100);
          hex = hsb2hex({
            h: hue,
            s: saturation,
            b: brightness
          });

          // Update UI
          slider.css('backgroundColor', hsb2hex({ h: hue, s: saturation, b: 100 }));
          break;

        case 'saturation':
          // Calculate hue, saturation, and brightness
          hue = keepWithin(parseInt(gridPos.x * (360 / grid.width()), 10), 0, 360);
          saturation = keepWithin(100 - Math.floor(sliderPos.y * (100 / slider.height())), 0, 100);
          brightness = keepWithin(100 - Math.floor(gridPos.y * (100 / grid.height())), 0, 100);
          hex = hsb2hex({
            h: hue,
            s: saturation,
            b: brightness
          });

          // Update UI
          slider.css('backgroundColor', hsb2hex({ h: hue, s: 100, b: brightness }));
          minicolors.find('.minicolors-grid-inner').css('opacity', saturation / 100);
          break;

        case 'brightness':
          // Calculate hue, saturation, and brightness
          hue = keepWithin(parseInt(gridPos.x * (360 / grid.width()), 10), 0, 360);
          saturation = keepWithin(100 - Math.floor(gridPos.y * (100 / grid.height())), 0, 100);
          brightness = keepWithin(100 - Math.floor(sliderPos.y * (100 / slider.height())), 0, 100);
          hex = hsb2hex({
            h: hue,
            s: saturation,
            b: brightness
          });

          // Update UI
          slider.css('backgroundColor', hsb2hex({ h: hue, s: saturation, b: 100 }));
          minicolors.find('.minicolors-grid-inner').css('opacity', 1 - (brightness / 100));
          break;

        default:
          // Calculate hue, saturation, and brightness
          hue = keepWithin(360 - parseInt(sliderPos.y * (360 / slider.height()), 10), 0, 360);
          saturation = keepWithin(Math.floor(gridPos.x * (100 / grid.width())), 0, 100);
          brightness = keepWithin(100 - Math.floor(gridPos.y * (100 / grid.height())), 0, 100);
          hex = hsb2hex({
            h: hue,
            s: saturation,
            b: brightness
          });

          // Update UI
          grid.css('backgroundColor', hsb2hex({ h: hue, s: 100, b: 100 }));
          break;
      }

      // Handle opacity
      if(settings.opacity) {
        opacity = parseFloat(1 - (opacityPos.y / opacitySlider.height())).toFixed(2);
      } else {
        opacity = 1;
      }

      updateInput(input, hex, opacity);
    }
    else {
      // Set swatch color
      swatch.find('span').css({
        backgroundColor: hex,
        opacity: String(opacity)
      });

      // Handle change event
      doChange(input, hex, opacity);
    }
  }

  // Sets the value of the input and does the appropriate conversions
  // to respect settings, also updates the swatch
  function updateInput(input, value, opacity) {
    var rgb;

    // Helpful references
    var minicolors = input.parent();
    var settings = input.data('minicolors-settings');
    var swatch = minicolors.find('.minicolors-input-swatch');

    if(settings.opacity) input.attr('data-opacity', opacity);

    // Set color string
    if(settings.format === 'rgb') {
      // Returns RGB(A) string

      // Checks for input format and does the conversion
      if(isRgb(value)) {
        rgb = parseRgb(value, true);
      }
      else {
        rgb = hex2rgb(parseHex(value, true));
      }

      opacity = input.attr('data-opacity') === '' ? 1 : keepWithin(parseFloat(input.attr('data-opacity')).toFixed(2), 0, 1);
      if(isNaN(opacity) || !settings.opacity) opacity = 1;

      if(input.minicolors('rgbObject').a <= 1 && rgb && settings.opacity) {
        // Set RGBA string if alpha
        value = 'rgba(' + rgb.r + ', ' + rgb.g + ', ' + rgb.b + ', ' + parseFloat(opacity) + ')';
      } else {
        // Set RGB string (alpha = 1)
        value = 'rgb(' + rgb.r + ', ' + rgb.g + ', ' + rgb.b + ')';
      }
    } else {
      // Returns hex color

      // Checks for input format and does the conversion
      if(isRgb(value)) {
        value = rgbString2hex(value);
      }

      value = convertCase(value, settings.letterCase);
    }

    // Update value from picker
    input.val(value);

    // Set swatch color
    swatch.find('span').css({
      backgroundColor: value,
      opacity: String(opacity)
    });

    // Handle change event
    doChange(input, value, opacity);
  }

  // Sets the color picker values from the input
  function updateFromInput(input, preserveInputValue) {
    var hex, hsb, opacity, keywords, alpha, value, x, y, r, phi;

    // Helpful references
    var minicolors = input.parent();
    var settings = input.data('minicolors-settings');
    var swatch = minicolors.find('.minicolors-input-swatch');

    // Panel objects
    var grid = minicolors.find('.minicolors-grid');
    var slider = minicolors.find('.minicolors-slider');
    var opacitySlider = minicolors.find('.minicolors-opacity-slider');

    // Picker objects
    var gridPicker = grid.find('[class$=-picker]');
    var sliderPicker = slider.find('[class$=-picker]');
    var opacityPicker = opacitySlider.find('[class$=-picker]');

    // Determine hex/HSB values
    if(isRgb(input.val())) {
      // If input value is a rgb(a) string, convert it to hex color and update opacity
      hex = rgbString2hex(input.val());
      alpha = keepWithin(parseFloat(getAlpha(input.val())).toFixed(2), 0, 1);
      if(alpha) {
        input.attr('data-opacity', alpha);
      }
    } else {
      hex = convertCase(parseHex(input.val(), true), settings.letterCase);
    }

    if(!hex){
      hex = convertCase(parseInput(settings.defaultValue, true), settings.letterCase);
    }
    hsb = hex2hsb(hex);

    // Get array of lowercase keywords
    keywords = !settings.keywords ? [] : $.map(settings.keywords.split(','), function(a) {
      return a.toLowerCase().trim();
    });

    // Set color string
    if(input.val() !== '' && $.inArray(input.val().toLowerCase(), keywords) > -1) {
      value = convertCase(input.val());
    } else {
      value = isRgb(input.val()) ? parseRgb(input.val()) : hex;
    }

    // Update input value
    if(!preserveInputValue) input.val(value);

    // Determine opacity value
    if(settings.opacity) {
      // Get from data-opacity attribute and keep within 0-1 range
      opacity = input.attr('data-opacity') === '' ? 1 : keepWithin(parseFloat(input.attr('data-opacity')).toFixed(2), 0, 1);
      if(isNaN(opacity)) opacity = 1;
      input.attr('data-opacity', opacity);
      swatch.find('span').css('opacity', String(opacity));

      // Set opacity picker position
      y = keepWithin(opacitySlider.height() - (opacitySlider.height() * opacity), 0, opacitySlider.height());
      opacityPicker.css('top', y + 'px');
    }

    // Set opacity to zero if input value is transparent
    if(input.val().toLowerCase() === 'transparent') {
      swatch.find('span').css('opacity', String(0));
    }

    // Update swatch
    swatch.find('span').css('backgroundColor', hex);

    // Determine picker locations
    switch(settings.control) {
      case 'wheel':
        // Set grid position
        r = keepWithin(Math.ceil(hsb.s * 0.75), 0, grid.height() / 2);
        phi = hsb.h * Math.PI / 180;
        x = keepWithin(75 - Math.cos(phi) * r, 0, grid.width());
        y = keepWithin(75 - Math.sin(phi) * r, 0, grid.height());
        gridPicker.css({
          top: y + 'px',
          left: x + 'px'
        });

        // Set slider position
        y = 150 - (hsb.b / (100 / grid.height()));
        if(hex === '') y = 0;
        sliderPicker.css('top', y + 'px');
        
        // Update panel color
        slider.css('backgroundColor', hsb2hex({ h: hsb.h, s: hsb.s, b: 100 }));
        break;

      case 'saturation':
        // Set grid position
        x = keepWithin((5 * hsb.h) / 12, 0, 150);
        y = keepWithin(grid.height() - Math.ceil(hsb.b / (100 / grid.height())), 0, grid.height());
        gridPicker.css({
          top: y + 'px',
          left: x + 'px'
        });

        // Set slider position
        y = keepWithin(slider.height() - (hsb.s * (slider.height() / 100)), 0, slider.height());
        sliderPicker.css('top', y + 'px');

        // Update UI
        slider.css('backgroundColor', hsb2hex({ h: hsb.h, s: 100, b: hsb.b }));
        minicolors.find('.minicolors-grid-inner').css('opacity', hsb.s / 100);
        break;

      case 'brightness':
        // Set grid position
        x = keepWithin((5 * hsb.h) / 12, 0, 150);
        y = keepWithin(grid.height() - Math.ceil(hsb.s / (100 / grid.height())), 0, grid.height());
        gridPicker.css({
          top: y + 'px',
          left: x + 'px'
        });

        // Set slider position
        y = keepWithin(slider.height() - (hsb.b * (slider.height() / 100)), 0, slider.height());
        sliderPicker.css('top', y + 'px');

        // Update UI
        slider.css('backgroundColor', hsb2hex({ h: hsb.h, s: hsb.s, b: 100 }));
        minicolors.find('.minicolors-grid-inner').css('opacity', 1 - (hsb.b / 100));
        break;

      default:
        // Set grid position
        x = keepWithin(Math.ceil(hsb.s / (100 / grid.width())), 0, grid.width());
        y = keepWithin(grid.height() - Math.ceil(hsb.b / (100 / grid.height())), 0, grid.height());
        gridPicker.css({
          top: y + 'px',
          left: x + 'px'
        });

        // Set slider position
        y = keepWithin(slider.height() - (hsb.h / (360 / slider.height())), 0, slider.height());
        sliderPicker.css('top', y + 'px');

        // Update panel color
        grid.css('backgroundColor', hsb2hex({ h: hsb.h, s: 100, b: 100 }));
        break;
    }

    // Fire change event, but only if minicolors is fully initialized
    if(input.data('minicolors-initialized')) {
      doChange(input, value, opacity);
    }
  }

  // Runs the change and changeDelay callbacks
  function doChange(input, value, opacity) {
    var settings = input.data('minicolors-settings');
    var lastChange = input.data('minicolors-lastChange');
    var obj, sel, i;

    // Only run if it actually changed
    if(!lastChange || lastChange.value !== value || lastChange.opacity !== opacity) {

      // Remember last-changed value
      input.data('minicolors-lastChange', {
        value: value,
        opacity: opacity
      });

      // Check and select applicable swatch
      if(settings.swatches && settings.swatches.length !== 0) {
        if(!isRgb(value)) {
          obj = hex2rgb(value);
        }
        else {
          obj = parseRgb(value, true);
        }
        sel = -1;
        for(i = 0; i < settings.swatches.length; ++i) {
          if(obj.r === settings.swatches[i].r && obj.g === settings.swatches[i].g && obj.b === settings.swatches[i].b && obj.a === settings.swatches[i].a) {
            sel = i;
            break;
          }
        }

        input.parent().find('.minicolors-swatches .minicolors-swatch').removeClass('selected');
        if(sel !== -1) {
          input.parent().find('.minicolors-swatches .minicolors-swatch').eq(i).addClass('selected');
        }
      }

      // Fire change event
      if(settings.change) {
        if(settings.changeDelay) {
          // Call after a delay
          clearTimeout(input.data('minicolors-changeTimeout'));
          input.data('minicolors-changeTimeout', setTimeout(function() {
            settings.change.call(input.get(0), value, opacity);
          }, settings.changeDelay));
        } else {
          // Call immediately
          settings.change.call(input.get(0), value, opacity);
        }
      }
      input.trigger('change').trigger('input');
    }
  }

  // Generates an RGB(A) object based on the input's value
  function rgbObject(input) {
    var rgb,
      opacity = $(input).attr('data-opacity');
    if( isRgb($(input).val()) ) {
      rgb = parseRgb($(input).val(), true);
    } else {
      var hex = parseHex($(input).val(), true);
      rgb = hex2rgb(hex);
    }
    if( !rgb ) return null;
    if( opacity !== undefined ) $.extend(rgb, { a: parseFloat(opacity) });
    return rgb;
  }

  // Generates an RGB(A) string based on the input's value
  function rgbString(input, alpha) {
    var rgb,
      opacity = $(input).attr('data-opacity');
    if( isRgb($(input).val()) ) {
      rgb = parseRgb($(input).val(), true);
    } else {
      var hex = parseHex($(input).val(), true);
      rgb = hex2rgb(hex);
    }
    if( !rgb ) return null;
    if( opacity === undefined ) opacity = 1;
    if( alpha ) {
      return 'rgba(' + rgb.r + ', ' + rgb.g + ', ' + rgb.b + ', ' + parseFloat(opacity) + ')';
    } else {
      return 'rgb(' + rgb.r + ', ' + rgb.g + ', ' + rgb.b + ')';
    }
  }

  // Converts to the letter case specified in settings
  function convertCase(string, letterCase) {
    return letterCase === 'uppercase' ? string.toUpperCase() : string.toLowerCase();
  }

  // Parses a string and returns a valid hex string when possible
  function parseHex(string, expand) {
    string = string.replace(/^#/g, '');
    if(!string.match(/^[A-F0-9]{3,6}/ig)) return '';
    if(string.length !== 3 && string.length !== 6) return '';
    if(string.length === 3 && expand) {
      string = string[0] + string[0] + string[1] + string[1] + string[2] + string[2];
    }
    return '#' + string;
  }

  // Parses a string and returns a valid RGB(A) string when possible
  function parseRgb(string, obj) {
    var values = string.replace(/[^\d,.]/g, '');
    var rgba = values.split(',');

    rgba[0] = keepWithin(parseInt(rgba[0], 10), 0, 255);
    rgba[1] = keepWithin(parseInt(rgba[1], 10), 0, 255);
    rgba[2] = keepWithin(parseInt(rgba[2], 10), 0, 255);
    if(rgba[3] !== undefined) {
      rgba[3] = keepWithin(parseFloat(rgba[3], 10), 0, 1);
    }

    // Return RGBA object
    if( obj ) {
      if (rgba[3] !== undefined) {
        return {
          r: rgba[0],
          g: rgba[1],
          b: rgba[2],
          a: rgba[3]
        };
      } else {
        return {
          r: rgba[0],
          g: rgba[1],
          b: rgba[2]
        };
      }
    }

    // Return RGBA string
    if(typeof(rgba[3]) !== 'undefined' && rgba[3] <= 1) {
      return 'rgba(' + rgba[0] + ', ' + rgba[1] + ', ' + rgba[2] + ', ' + rgba[3] + ')';
    } else {
      return 'rgb(' + rgba[0] + ', ' + rgba[1] + ', ' + rgba[2] + ')';
    }

  }

  // Parses a string and returns a valid color string when possible
  function parseInput(string, expand) {
    if(isRgb(string)) {
      // Returns a valid rgb(a) string
      return parseRgb(string);
    } else {
      return parseHex(string, expand);
    }
  }

  // Keeps value within min and max
  function keepWithin(value, min, max) {
    if(value < min) value = min;
    if(value > max) value = max;
    return value;
  }

  // Checks if a string is a valid RGB(A) string
  function isRgb(string) {
    var rgb = string.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
    return (rgb && rgb.length === 4) ? true : false;
  }

  // Function to get alpha from a RGB(A) string
  function getAlpha(rgba) {
    rgba = rgba.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+(\.\d{1,2})?|\.\d{1,2})[\s+]?/i);
    return (rgba && rgba.length === 6) ? rgba[4] : '1';
  }

  // Converts an HSB object to an RGB object
  function hsb2rgb(hsb) {
    var rgb = {};
    var h = Math.round(hsb.h);
    var s = Math.round(hsb.s * 255 / 100);
    var v = Math.round(hsb.b * 255 / 100);
    if(s === 0) {
      rgb.r = rgb.g = rgb.b = v;
    } else {
      var t1 = v;
      var t2 = (255 - s) * v / 255;
      var t3 = (t1 - t2) * (h % 60) / 60;
      if(h === 360) h = 0;
      if(h < 60) { rgb.r = t1; rgb.b = t2; rgb.g = t2 + t3; }
      else if(h < 120) {rgb.g = t1; rgb.b = t2; rgb.r = t1 - t3; }
      else if(h < 180) {rgb.g = t1; rgb.r = t2; rgb.b = t2 + t3; }
      else if(h < 240) {rgb.b = t1; rgb.r = t2; rgb.g = t1 - t3; }
      else if(h < 300) {rgb.b = t1; rgb.g = t2; rgb.r = t2 + t3; }
      else if(h < 360) {rgb.r = t1; rgb.g = t2; rgb.b = t1 - t3; }
      else { rgb.r = 0; rgb.g = 0; rgb.b = 0; }
    }
    return {
      r: Math.round(rgb.r),
      g: Math.round(rgb.g),
      b: Math.round(rgb.b)
    };
  }

  // Converts an RGB string to a hex string
  function rgbString2hex(rgb){
    rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
    return (rgb && rgb.length === 4) ? '#' +
      ('0' + parseInt(rgb[1],10).toString(16)).slice(-2) +
      ('0' + parseInt(rgb[2],10).toString(16)).slice(-2) +
      ('0' + parseInt(rgb[3],10).toString(16)).slice(-2) : '';
  }

  // Converts an RGB object to a hex string
  function rgb2hex(rgb) {
    var hex = [
      rgb.r.toString(16),
      rgb.g.toString(16),
      rgb.b.toString(16)
    ];
    $.each(hex, function(nr, val) {
      if(val.length === 1) hex[nr] = '0' + val;
    });
    return '#' + hex.join('');
  }

  // Converts an HSB object to a hex string
  function hsb2hex(hsb) {
    return rgb2hex(hsb2rgb(hsb));
  }

  // Converts a hex string to an HSB object
  function hex2hsb(hex) {
    var hsb = rgb2hsb(hex2rgb(hex));
    if(hsb.s === 0) hsb.h = 360;
    return hsb;
  }

  // Converts an RGB object to an HSB object
  function rgb2hsb(rgb) {
    var hsb = { h: 0, s: 0, b: 0 };
    var min = Math.min(rgb.r, rgb.g, rgb.b);
    var max = Math.max(rgb.r, rgb.g, rgb.b);
    var delta = max - min;
    hsb.b = max;
    hsb.s = max !== 0 ? 255 * delta / max : 0;
    if(hsb.s !== 0) {
      if(rgb.r === max) {
        hsb.h = (rgb.g - rgb.b) / delta;
      } else if(rgb.g === max) {
        hsb.h = 2 + (rgb.b - rgb.r) / delta;
      } else {
        hsb.h = 4 + (rgb.r - rgb.g) / delta;
      }
    } else {
      hsb.h = -1;
    }
    hsb.h *= 60;
    if(hsb.h < 0) {
      hsb.h += 360;
    }
    hsb.s *= 100/255;
    hsb.b *= 100/255;
    return hsb;
  }

  // Converts a hex string to an RGB object
  function hex2rgb(hex) {
    hex = parseInt(((hex.indexOf('#') > -1) ? hex.substring(1) : hex), 16);
    return {
      r: hex >> 16,
      g: (hex & 0x00FF00) >> 8,
      b: (hex & 0x0000FF)
    };
  }

  // Handle events
  $([document])
    // Hide on clicks outside of the control
    .on('mousedown.minicolors touchstart.minicolors', function(event) {
      if(!$(event.target).parents().add(event.target).hasClass('minicolors')) {
        hide();
      }
    })
    // Start moving
    .on('mousedown.minicolors touchstart.minicolors', '.minicolors-grid, .minicolors-slider, .minicolors-opacity-slider', function(event) {
      var target = $(this);
      event.preventDefault();
      $(event.delegateTarget).data('minicolors-target', target);
      move(target, event, true);
    })
    // Move pickers
    .on('mousemove.minicolors touchmove.minicolors', function(event) {
      var target = $(event.delegateTarget).data('minicolors-target');
      if(target) move(target, event);
    })
    // Stop moving
    .on('mouseup.minicolors touchend.minicolors', function() {
      $(this).removeData('minicolors-target');
    })
    // Selected a swatch
    .on('click.minicolors', '.minicolors-swatches li', function(event) {
      event.preventDefault();
      var target = $(this), input = target.parents('.minicolors').find('.minicolors-input'), color = target.data('swatch-color');
      updateInput(input, color, getAlpha(color));
      updateFromInput(input);
    })
    // Show panel when swatch is clicked
    .on('mousedown.minicolors touchstart.minicolors', '.minicolors-input-swatch', function(event) {
      var input = $(this).parent().find('.minicolors-input');
      event.preventDefault();
      show(input);
    })
    // Show on focus
    .on('focus.minicolors', '.minicolors-input', function() {
      var input = $(this);
      if(!input.data('minicolors-initialized')) return;
      show(input);
    })
    // Update value on blur
    .on('blur.minicolors', '.minicolors-input', function() {
      var input = $(this);
      var settings = input.data('minicolors-settings');
      var keywords;
      var hex;
      var rgba;
      var swatchOpacity;
      var value;

      if(!input.data('minicolors-initialized')) return;

      // Get array of lowercase keywords
      keywords = !settings.keywords ? [] : $.map(settings.keywords.split(','), function(a) {
        return a.toLowerCase().trim();
      });

      // Set color string
      if(input.val() !== '' && $.inArray(input.val().toLowerCase(), keywords) > -1) {
        value = input.val();
      } else {
        // Get RGBA values for easy conversion
        if(isRgb(input.val())) {
          rgba = parseRgb(input.val(), true);
        } else {
          hex = parseHex(input.val(), true);
          rgba = hex ? hex2rgb(hex) : null;
        }

        // Convert to format
        if(rgba === null) {
          value = settings.defaultValue;
        } else if(settings.format === 'rgb') {
          value = settings.opacity ?
            parseRgb('rgba(' + rgba.r + ',' + rgba.g + ',' + rgba.b + ',' + input.attr('data-opacity') + ')') :
            parseRgb('rgb(' + rgba.r + ',' + rgba.g + ',' + rgba.b + ')');
        } else {
          value = rgb2hex(rgba);
        }
      }

      // Update swatch opacity
      swatchOpacity = settings.opacity ? input.attr('data-opacity') : 1;
      if(value.toLowerCase() === 'transparent') swatchOpacity = 0;
      input
        .closest('.minicolors')
        .find('.minicolors-input-swatch > span')
        .css('opacity', String(swatchOpacity));

      // Set input value
      input.val(value);

      // Is it blank?
      if(input.val() === '') input.val(parseInput(settings.defaultValue, true));

      // Adjust case
      input.val(convertCase(input.val(), settings.letterCase));

    })
    // Handle keypresses
    .on('keydown.minicolors', '.minicolors-input', function(event) {
      var input = $(this);
      if(!input.data('minicolors-initialized')) return;
      switch(event.which) {
        case 9: // tab
          hide();
          break;
        case 13: // enter
        case 27: // esc
          hide();
          input.blur();
          break;
      }
    })
    // Update on keyup
    .on('keyup.minicolors', '.minicolors-input', function() {
      var input = $(this);
      if(!input.data('minicolors-initialized')) return;
      updateFromInput(input, true);
    })
    // Update on paste
    .on('paste.minicolors', '.minicolors-input', function() {
      var input = $(this);
      if(!input.data('minicolors-initialized')) return;
      setTimeout(function() {
        updateFromInput(input, true);
      }, 1);
    });
}));
