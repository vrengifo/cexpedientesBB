bb._C_[bb.cr_]={};bb._C_[bb.cr_]['schema']=function(a){var g_=a._z_,T_=g_.getAttribute('targetNamespace');if(T_){var b=bb.d5_[T_];if(!b){b=bb.hs_(T_,g_.getAttribute('version'));bb.d5_[T_]=b;}bb.af_(g_,bb.C_['schema'],b,a);}else{bb.f_(2,g_,0,13,'targetNamespace',g_.nodeName);}};bb.C_={};bb.C_['schema']={};bb.C_['schema']['import']=function(g_,a){};bb.C_['schema']['annotation']=function(g_,a){};bb.C_['schema']['simpleType']=function(g_,a){var a_=g_.getAttribute('name');if(a_){var b=bb.d3_(a_,a);a.Z_[a_]=b;bb.af_(g_,bb.C_['simpleType'],b);}else{bb.f_(2,g_,0,13,'name',g_.nodeName);}};bb.C_['simpleType']={};bb.C_['simpleType']['list']=function(g_,a){a.bB_=3;a.a7_=3;var b=g_.getAttribute('itemType'),c=b?bb.aw_(g_,b)[0]:null;a.hp_=c?c[0]:null;a.hq_=c?c[1]:null;bb.af_(g_,bb.C_['list'],a);};bb.C_['simpleType']['union']=function(g_,a){a.bB_=4;a.a7_=4;var b=g_.getAttribute('memberTypes'),c=b?bb.aw_(g_,b):[];a.bC_=[];for(var d=0;d<c.length;d++){a.bC_.push([c[d][0],c[d][1]]);}bb.af_(g_,bb.C_['union'],a);};bb.C_['union']={};bb.C_['union']['simpleType']=function(g_,_a_){var a=bb.d3_(null,_a_.d4_);_a_.bC_.push(a);bb.af_(g_,bb.C_['simpleType'],a);};bb.C_['list']={};bb.C_['list']['simpleType']=function(g_,_a_){var a=bb.d3_(null,_a_.d4_);_a_.bj_=a;bb.af_(g_,bb.C_['simpleType'],a);};bb.C_['simpleType']['restriction']=function(g_,a){var b=g_.getAttribute('base'),c=b?bb.aw_(g_,b)[0]:null;a.bB_=2;if(c){a.hn_=c[0];a.ho_=c[1];}bb.af_(g_,bb.C_['restriction'],a);};bb.C_['restriction']={};bb.C_['restriction']['simpleType']=function(g_,_a_){var a=bb.d3_(null,_a_.d4_);_a_._a_=a;bb.af_(g_,bb.C_['simpleType'],a);};bb.C_['restriction']['enumeration']=function(g_,_a_){_a_.fB_.push(g_.getAttribute('value'));};bb.C_['enumeration']={};bb.C_['restriction']['fractionDigits']=bb.C_['restriction']['length']=bb.C_['restriction']['maxExclusive']=bb.C_['restriction']['maxInclusive']=bb.C_['restriction']['maxLength']=bb.C_['restriction']['minExclusive']=bb.C_['restriction']['minInclusive']=bb.C_['restriction']['minLength']=bb.C_['restriction']['totalDigits']=function(g_,_a_){var a=bb.fC_(g_.localName||g_.baseName,g_.getAttribute('value'),g_.getAttribute('fixed')=='true');_a_._o_.push(a);};bb.C_['fractionDigits']={};bb.C_['length']={};bb.C_['maxExclusive']={};bb.C_['maxInclusive']={};bb.C_['maxLength']={};bb.C_['minExclusive']={};bb.C_['minInclusive']={};bb.C_['minLength']={};bb.C_['totalDigits']={};bb.C_['restriction']['pattern']=function(g_,_a_){var a=bb.hm_(g_.getAttribute('value'));_a_._o_.push(a);};bb.C_['pattern']={};bb.C_['restriction']['whiteSpace']=function(g_,_a_){var a=bb.fC_(g_.localName||g_.baseName,g_.getAttribute('value'),g_.getAttribute('fixed')=='true');_a_.bl_=a;};bb.C_['whiteSpace']={};bb.C_['simpleType']['annotation']=bb.C_['list']['annotation']=bb.C_['union']['annotation']=bb.C_['restriction']['annotation']=bb.C_['enumeration']['annotation']=bb.C_['fractionDigits']['annotation']=bb.C_['maxExclusive']['annotation']=bb.C_['maxInclusive']['annotation']=bb.C_['maxLength']['annotation']=bb.C_['minExclusive']['annotation']=bb.C_['minInclusive']['annotation']=bb.C_['minLength']['annotation']=bb.C_['pattern']['annotation']=bb.C_['totalDigits']['annotation']=bb.C_['whiteSpace']['annotation']=function(g_,a){};