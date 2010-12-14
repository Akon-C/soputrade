﻿/*
 * FCKeditor - The text editor for Internet - http://www.fckeditor.net
 * Copyright (C) 2003-2007 Frederico Caldeira Knabben
 * 
 * == BEGIN LICENSE ==
 * 
 * Licensed under the terms of any of the following licenses at your
 * choice:
 * 
 *  - GNU General Public License Version 2 or later (the "GPL")
 *    http://www.gnu.org/licenses/gpl.html
 * 
 *  - GNU Lesser General Public License Version 2.1 or later (the "LGPL")
 *    http://www.gnu.org/licenses/lgpl.html
 * 
 *  - Mozilla Public License Version 1.1 or later (the "MPL")
 *    http://www.mozilla.org/MPL/MPL-1.1.html
 * 
 * == END LICENSE ==
 * 
 * File Name: fcktablehandler_gecko.js
 * 	Manage table operations (IE specific).
 * 
 * File Authors:
 * 		Frederico Caldeira Knabben (www.fckeditor.net)
 */

FCKTableHandler.GetSelectedCells = function()
{
	var aCells = new Array() ;

	var oSelection = FCK.EditorWindow.getSelection() ;

	// If the selection is a text.
	if ( oSelection.rangeCount == 1 && oSelection.anchorNode.nodeType == 3 )
	{
		var oParent = FCKTools.GetElementAscensor( oSelection.anchorNode, 'TD,TH' ) ;
		
		if ( oParent )
		{
			aCells[0] = oParent ;
			return aCells ;
		}	
	}

	for ( var i = 0 ; i < oSelection.rangeCount ; i++ )
	{
		var oRange = oSelection.getRangeAt(i) ;
		var oCell ;
		
		if ( oRange.startContainer.tagName.Equals( 'TD', 'TH' ) )
			oCell = oRange.startContainer ;
		else
			oCell = oRange.startContainer.childNodes[ oRange.startOffset ] ;
		
		if ( oCell.tagName.Equals( 'TD', 'TH' ) )
			aCells[aCells.length] = oCell ;
	}

	return aCells ;
}
